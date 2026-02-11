<?php

namespace App\Imports;

use App\Models\AsetPju;
use App\Models\PanelKwh;
use App\Models\MasterJalan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AsetPjuSheetImport implements ToModel, WithHeadingRow
{
    private $kapanewon;

    public function __construct($kapanewon) {
        $this->kapanewon = $kapanewon;
    }

    public function model(array $row)
    {
        $title = (string)($row['title'] ?? '');
        $desc = (string)($row['description'] ?? '');

        // 1. Relasi Master Jalan
        $jalan = MasterJalan::firstOrCreate(['nama_jalan' => trim($title) ?: 'Tanpa Nama']);

        // 2. BERSIHKAN KOORDINAT PJU (Ubah koma jadi titik & Pastikan format Float)
        $latRaw = str_replace(',', '.', (string)($row['latitude'] ?? '0'));
        $lonRaw = str_replace(',', '.', (string)($row['longitude'] ?? '0'));

        $lat = (float)$latRaw;
        $lon = (float)$lonRaw;

        // Fix Koordinat "Milyaran"
        if (abs($lat) > 90) {
            $cleanLat = preg_replace('/[^0-9]/', '', (string)$lat);
            $lat = (float)('-' . substr($cleanLat, 0, 1) . '.' . substr($cleanLat, 1));
        }
        if (abs($lon) > 180) {
            $cleanLon = preg_replace('/[^0-9]/', '', (string)$lon);
            $lon = (float)(substr($cleanLon, 0, 3) . '.' . substr($cleanLon, 3));
        }

        if (empty($lon) || $lon == 0) return null;

        // 3. CARI PANEL KWH MENGGUNAKAN POSTGRESQL-SAFE QUERY
        $searchTitle = trim(str_ireplace('kwh', '', $title));
        
        $nearestKwh = PanelKwh::select('*')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                [$lat, $lon, $lat]
            )
            ->where('catatan_admin_pln', 'LIKE', '%' . $searchTitle . '%')
            ->orderBy('distance')
            ->first();

        // Fallback: Hapus 'having' dari SQL, lakukan pengecekan jarak di level PHP
        if (!$nearestKwh) {
            $nearestKwh = PanelKwh::select('*')
                ->selectRaw(
                    '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                    [$lat, $lon, $lat]
                )
                ->orderBy('distance')
                ->first();

            // Pengecekan pengganti HAVING: Batalkan jika jaraknya > 2 KM
            if ($nearestKwh && $nearestKwh->distance > 2) {
                $nearestKwh = null; 
            }
        }

        // 4. SET PANEL ID & EKSTRAK DESA
        $panelKwhId = null;
        $desa = null;

        if ($nearestKwh) {
            $panelKwhId = $nearestKwh->id;
            if ($nearestKwh->lokasi_panel) {
                $bersihkanAlamat = preg_replace('/^alamat\s*:\s*/i', '', $nearestKwh->lokasi_panel);
                $desa = substr(trim($bersihkanAlamat), 0, 50);
            }
        }

        // 5. Ekstrak Jenis Lampu & Daya
        $jenisLampu = str_contains(strtolower($desc), 'led') ? 'LED' : 'Konvensional';
        $watt = 120; 
        if (preg_match('/Daya\s*=\s*(\d+)/i', $desc, $matchWatt)) {
            $watt = (int)$matchWatt[1];
        }

        // 6. Kode Tiang Unik
        $uniqueSeed = $title . $lat . $lon . microtime();
        $kodeTiang = 'PJU-' . strtoupper(substr($this->kapanewon, 0, 3)) . '-' . substr(md5($uniqueSeed), 0, 8);

        // 7. Simpan Data PJU
        return new AsetPju([
            'panel_kwh_id' => $panelKwhId,
            'jalan_id'     => $jalan->id,
            'kode_tiang'   => substr($kodeTiang, 0, 20),
            'jenis_lampu'  => $jenisLampu,
            'watt'         => $watt,
            'status_aset'  => 'Terelialisasi',
            'warna_map'    => 'Hijau',
            'latitude'     => $lat,
            'longitude'    => $lon,
            'kecamatan'    => $this->kapanewon,
            'desa'         => $desa ?: '-', 
        ]);
    }
}