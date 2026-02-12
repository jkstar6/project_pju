<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\PanelKwhImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Models\PanelKwh;
use App\Models\AsetPju;

class ImportPanel extends Command
{
    /**
     * Nama perintah yang dijalankan di terminal.
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
        $folderPath = storage_path('app/excel_data');

        // Proteksi jika folder tidak ada
        if (!File::isDirectory($folderPath)) {
            $this->error("Folder tidak ditemukan! Silakan buat folder di: storage/app/excel_data");
            return;
        }

        $files = File::files($folderPath);
        
        if (count($files) === 0) {
            $this->warn("Tidak ada file Excel di dalam folder tersebut.");
            return;
        }

        // Kosongkan tabel agar data benar-benar bersih sebelum import
        // Matikan sementara constraint agar bisa menghapus tabel yang berelasi
        Schema::disableForeignKeyConstraints();
        AsetPju::truncate();
        PanelKwh::truncate();
        Schema::enableForeignKeyConstraints();

        $this->info("Ditemukan " . count($files) . " file. Tabel telah dikosongkan. Memulai proses import...");
        $this->output->progressStart(count($files));

        foreach ($files as $file) {
            $fileName = $file->getFilename();
            
            // Mengambil nama Kapanewon dari nama file (ditambahkan trim untuk hapus spasi nyasar)
            $namaKapanewon = trim(str_ireplace(['Kapanewon ', '.xls', '.xlsx'], '', $fileName));
            
            try {
                // Masukkan $namaKapanewon ke dalam import
                Excel::import(new PanelKwhImport($namaKapanewon), $file->getRealPath());
                
                $this->line("\n ✅ Berhasil: $fileName");
            } catch (\Exception $e) {
                $this->error("\n ❌ Gagal di file $fileName: " . $e->getMessage());
            }

            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
        $this->info("Sedang membuat data tabel koneksi jaringan (koneksi_pju_kwh)...");
        $this->call('db:seed', ['--class' => 'KoneksiPjuSeeder']);

        $this->info("Semua proses selesai! Silakan cek database PostgreSQL Anda.");
    }
}