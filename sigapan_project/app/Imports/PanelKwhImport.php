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

    private $kapanewon;

    // Tambahkan ini agar bisa menerima nama wilayah dari Command
    public function __construct($kapanewon)
    {
        $this->kapanewon = $kapanewon;
    }

    public function uniqueBy()
    {
        return 'no_pelanggan_pln';
    }

    public function model(array $row)
    {
        $latKey = $this->findKey($row, 'latitude');
        $lonKey = $this->findKey($row, 'longitude');
        $descKey = $this->findKey($row, 'description');
        $titleKey = $this->findKey($row, 'title');

        $latitude = $row[$latKey] ?? 0;
        $longitude = $row[$lonKey] ?? 0;
        $desc = (string)($row[$descKey] ?? '');

        // LOGIKA PERBAIKAN KOORDINAT (Auto-Fix Pandak & Sewon)
        $latitude = preg_replace('/[^0-9.-]/', '', $latitude);
        $longitude = preg_replace('/[^0-9.-]/', '', $longitude);

        if (abs((float)$latitude) > 10) {
            $cleanLat = preg_replace('/[^0-9]/', '', $latitude);
            $latitude = '-' . substr($cleanLat, 0, 1) . '.' . substr($cleanLat, 1);
        }

        if (abs((float)$longitude) > 1000) {
            $cleanLon = preg_replace('/[^0-9]/', '', $longitude);
            $longitude = substr($cleanLon, 0, 3) . '.' . substr($cleanLon, 3);
        }

        if (empty($longitude) || (float)$longitude == 0) {
            return null;
        }

        // EKSTRAK ID PELANGGAN
        preg_match('/5210\d{7,9}|\d{11,12}/', $desc, $matchId);
        $no_pelanggan = $matchId[0] ?? null;

        if (!$no_pelanggan) return null;

        // EKSTRAK DAYA & LOKASI
        preg_match('/(?:Daya|Kwh)\s*[:]?\s*(\d+)/i', $desc, $matchDaya);
        $daya = $matchDaya[1] ?? 1300;
        $lokasi = trim(str_ireplace('Alamat :', '', explode("\n", $desc)[0]));

        return new PanelKwh([
            'no_pelanggan_pln' => $no_pelanggan,
            'kapanewon'        => $this->kapanewon, // DISIMPAN DI SINI
            'lokasi_panel'     => $lokasi ?: 'Lokasi Terdeteksi',
            'latitude'         => (float)$latitude,
            'longitude'        => (float)$longitude,
            'daya_va'          => $daya,
            'catatan_admin_pln'=> $row[$titleKey] ?? null,
        ]);
    }

    private function findKey(array $row, $search)
    {
        foreach ($row as $key => $value) {
            $cleanKey = str_replace([' ', '_'], '', strtolower((string)$key));
            if (str_contains($cleanKey, strtolower($search))) {
                return $key;
            }
        }
        return $search;
    }
}