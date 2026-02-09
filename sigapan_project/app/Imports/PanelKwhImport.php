<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets; // Tambahkan ini

class PanelKwhImport implements WithMultipleSheets, SkipsUnknownSheets
{
    private $kapanewon;

    public function __construct($kapanewon) {
        $this->kapanewon = $kapanewon;
    }

    public function sheets(): array {
        return [
            0 => new PanelKwhSheetImport($this->kapanewon),
            'PJU' => new AsetPjuSheetImport($this->kapanewon),
            'LPJU' => new AsetPjuSheetImport($this->kapanewon),
            'LPJU-TS' => new AsetPjuSheetImport($this->kapanewon),
        ];
    }

    public function onUnknownSheet($sheetName) {
        // Abaikan jika nama sheet tidak ditemukan, jangan lempar error
        return;
    }
}