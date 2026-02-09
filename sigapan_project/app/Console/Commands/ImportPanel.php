<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PanelKwhImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class ImportPanel extends Command
{
    /**
     * Nama perintah yang dijalankan di terminal.
     * Cukup ketik 'php artisan import:semua'
     */
    protected $signature = 'import:semua';

    /**
     * Deskripsi perintah.
     */
    protected $description = 'Import semua file Excel dari folder storage/app/excel_data ke database';

    /**
     * Eksekusi perintah.
     */
    public function handle()
    {
        // Menentukan lokasi folder data
        $folderPath = storage_path('app/excel_data');
        $files = \File::files($folderPath);

        // Kosongkan tabel agar data 'null' hilang
        \App\Models\PanelKwh::truncate();
        // Proteksi jika folder tidak ada
        if (!File::isDirectory($folderPath)) {
            $this->error("Folder tidak ditemukan! Silakan buat folder di: storage/app/excel_data");
            return;
        }

        // Ambil semua file dengan ekstensi .xls atau .xlsx
        $files = File::files($folderPath);
        
        if (count($files) === 0) {
            $this->warn("Tidak ada file Excel di dalam folder tersebut.");
            return;
        }

        $this->info("Ditemukan " . count($files) . " file. Memulai proses import...");
        $this->output->progressStart(count($files));

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            
            // Mengambil nama Kapanewon dari nama file
            // Contoh: "Kapanewon Dlingo.xls" menjadi "Dlingo"
            $namaKapanewon = str_ireplace(['Kapanewon ', '.xls', '.xlsx'], '', $fileName);
            
            try {
                // Masukkan $namaKapanewon ke dalam kurung PanelKwhImport
                Excel::import(new PanelKwhImport($namaKapanewon), $file->getRealPath());
                
                $this->line("\n ✅ Berhasil: $fileName");
            } catch (\Exception $e) {
                $this->error("\n ❌ Gagal di file $fileName: " . $e->getMessage());
            }

            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
        $this->info("Semua proses selesai! Silakan cek database PostgreSQL Anda.");
    }
}