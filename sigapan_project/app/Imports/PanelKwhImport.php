<?php

namespace App\Imports;

use App\Models\PanelKwh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PanelKwhImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Menangani data ganda berdasarkan ID Pelanggan.
     */
    public function uniqueBy()
    {
        return 'no_pelanggan_pln';
    }

    public function model(array $row)
    {
        // Cari kolom secara dinamis (tidak peduli huruf besar/kecil)
        $descKey = $this->findKey($row, 'description');
        $latKey  = $this->findKey($row, 'latitude');
        $lonKey  = $this->findKey($row, 'longitude');
        $titleKey = $this->findKey($row, 'title');

        $desc = (string)($row[$descKey] ?? '');
        if (empty($desc)) return null;

        // Regex untuk ID Pelanggan (Cari angka 11-12 digit atau yang diawali 5210)
        preg_match('/5210\d{7,9}|\d{11,12}/', $desc, $matchId);
        $no_pelanggan = $matchId[0] ?? null;

        if (!$no_pelanggan) return null;

        // Regex untuk Daya
        preg_match('/(?:Daya|Kwh)\s*[:]?\s*(\d+)/i', $desc, $matchDaya);
        $daya = $matchDaya[1] ?? 1300;

        // Ambil baris pertama deskripsi sebagai lokasi, buang kata 'Alamat :'
        $lines = explode("\n", $desc);
        $lokasi = trim(str_ireplace('Alamat :', '', $lines[0]));

        return new PanelKwh([
            'no_pelanggan_pln' => $no_pelanggan,
            'lokasi_panel'     => $lokasi ?: 'Lokasi Terdeteksi',
            'latitude'         => $row[$latKey] ?? 0,
            'longitude'        => $row[$lonKey] ?? 0,
            'daya_va'          => $daya,
            'catatan_admin_pln'=> $row[$titleKey] ?? null,
        ]);
    }

    /**
     * Fungsi pencarian kolom fleksibel
     */
    private function findKey(array $row, $search)
    {
        foreach ($row as $key => $value) {
            $cleanKey = str_replace([' ', '_'], '', strtolower($key));
            if (str_contains($cleanKey, strtolower($search))) {
                return $key;
            }
        }
        return $search;
    }
}