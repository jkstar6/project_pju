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

        // 1. Relasi Jalan & Panel
        $jalan = MasterJalan::firstOrCreate(['nama_jalan' => trim($title) ?: 'Tanpa Nama']);
        preg_match('/\d{11,12}/', $title, $matchId);
        $panel = $matchId ? PanelKwh::where('no_pelanggan_pln', $matchId[0])->first() : null;

        // 2. Fix Koordinat
        $lat = $row['latitude'] ?? 0;
        $lon = $row['longitude'] ?? 0;
        if (abs((float)$lat) > 90) {
            $cleanLat = preg_replace('/[^0-9]/', '', (string)$lat);
            $lat = '-' . substr($cleanLat, 0, 1) . '.' . substr($cleanLat, 1);
        }
        if (abs((float)$lon) > 180) {
            $cleanLon = preg_replace('/[^0-9]/', '', (string)$lon);
            $lon = substr($cleanLon, 0, 3) . '.' . substr($cleanLon, 3);
        }

        if (empty($lon) || (float)$lon == 0) return null;

        // 3. Kode Tiang Unik (Gunakan Hash dari baris data agar tidak tabrakan)
        $uniqueSeed = $title . $lat . $lon . microtime();
        $kodeTiang = 'PJU-' . strtoupper(substr($this->kapanewon, 0, 3)) . '-' . substr(md5($uniqueSeed), 0, 8);

        return new AsetPju([
            'panel_kwh_id' => $panel ? $panel->id : null,
            'jalan_id'     => $jalan->id,
            'kode_tiang'   => substr($kodeTiang, 0, 20),
            'jenis_lampu'  => str_contains(strtolower($desc), 'led') ? 'LED' : 'Konvensional',
            'watt'         => 120,
            'status_aset'  => 'Terelialisasi',
            'warna_map'    => 'Hijau',
            'latitude'     => (float)$lat,
            'longitude'    => (float)$lon,
            'kecamatan'    => $this->kapanewon,
        ]);
    }
}