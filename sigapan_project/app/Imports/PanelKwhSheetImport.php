<?php

namespace App\Imports;

use App\Models\PanelKwh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PanelKwhSheetImport implements ToModel, WithHeadingRow, WithUpserts
{
    private $kapanewon;
    
    public function __construct($kapanewon) { 
        $this->kapanewon = $kapanewon; 
    }
    
    public function uniqueBy() { 
        return 'no_pelanggan_pln'; 
    }

    public function model(array $row)
    {
        $desc = (string)($row['description'] ?? '');
        $title = trim((string)($row['title'] ?? ''));

        // Ekstrak ID Pelanggan
        preg_match('/5210\d{7,9}|\d{11,12}/', $desc, $matchId);
        $no_pelanggan = $matchId[0] ?? null;

        if (!$no_pelanggan) return null;

        // BERSUKAN KOORDINAT: Ubah koma menjadi titik
        $lat = str_replace(',', '.', (string)($row['latitude'] ?? '0'));
        $lon = str_replace(',', '.', (string)($row['longitude'] ?? '0'));

        // Fix Koordinat "Milyaran"
        if (abs((float)$lat) > 90) {
            $cleanLat = preg_replace('/[^0-9]/', '', $lat);
            $lat = '-' . substr($cleanLat, 0, 1) . '.' . substr($cleanLat, 1);
        }
        if (abs((float)$lon) > 180) {
            $cleanLon = preg_replace('/[^0-9]/', '', $lon);
            $lon = substr($cleanLon, 0, 3) . '.' . substr($cleanLon, 3);
        }

        $alamat = trim(explode("\n", $desc)[0]);

        return new PanelKwh([
            'no_pelanggan_pln'  => $no_pelanggan,
            'lokasi_panel'      => $alamat,
            'latitude'          => (float)$lat,
            'longitude'         => (float)$lon,
            'daya_va'           => 1300,
            'catatan_admin_pln' => $title, 
        ]);
    }
}