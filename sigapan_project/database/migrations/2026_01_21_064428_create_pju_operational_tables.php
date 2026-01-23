<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel Aset PJU
        Schema::create('aset_pju', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panel_kwh_id')
                ->nullable()
                ->constrained('panel_kwh')
                ->nullOnDelete();
            $table->foreignId('jalan_id')
                ->nullable()
                ->constrained('master_jalan')
                ->nullOnDelete();
            $table->string('kode_tiang', 20)->unique();
            $table->string('jenis_lampu', 50)->nullable();
            $table->integer('watt')->nullable();
            $table->enum('status_aset', ['Usulan', 'Pengerjaan', 'Terelialisasi', 'Pindah', 'Mati'])->default('Usulan');
            $table->enum('warna_map', ['Kuning', 'Biru', 'Hijau', 'Merah', 'Hitam'])->default('Kuning');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('kecamatan', 50)->nullable();
            $table->string('desa', 50)->nullable();
            $table->timestamps();
        });

        // 2. Tabel Koneksi Jaringan
        Schema::create('koneksi_pju_kwh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_pju_id')->constrained('aset_pju')->onDelete('cascade');
            $table->foreignId('panel_kwh_id')->constrained('panel_kwh')->onDelete('cascade');
            $table->string('nomor_mcb_panel', 20)->nullable();
            $table->enum('fasa', ['R', 'S', 'T'])->nullable();
            $table->enum('status_koneksi', ['Aktif', 'Diputus'])->default('Aktif');
            $table->date('tgl_koneksi')->nullable();
            $table->decimal('panjang_kabel_est', 6, 2)->nullable();
            $table->text('keterangan_jalur')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // 3. Tabel Progres Pengerjaan
        Schema::create('progres_pengerjaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_pju_id')->constrained('aset_pju')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('tahapan', ['Galian', 'Pengecoran', 'Pemasangan Tiang dan Armatur', 'Pemasangan Jaringan', 'Selesai']);
            $table->timestamp('tgl_update')->useCurrent();
            $table->text('keterangan')->nullable();
            $table->decimal('latitude_log', 10, 8)->nullable();
            $table->decimal('longitude_log', 11, 8)->nullable();
        });

        // 4. Tabel Log Survey
        Schema::create('log_survey', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_pju_id')->constrained('aset_pju');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tgl_survey');
            $table->enum('kondisi', ['Nyala', 'Mati', 'Rusak Fisik']);
            $table->enum('keberadaan', ['Ada', 'Hilang'])->default('Ada');
            $table->decimal('lat_input', 10, 8);
            $table->decimal('long_input', 11, 8);
            $table->text('catatan_kerusakan')->nullable();
            $table->timestamps();
        });

        // 5. Tabel Pengaduan Masyarakat
        Schema::create('pengaduan_masyarakat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor', 100);
            $table->string('no_hp', 20);
            $table->enum('tipe_aduan', ['Lampu Mati', 'Permohonan PJU Baru']);
            $table->text('deskripsi_lokasi');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('foto_lapangan')->nullable();
            $table->enum('status_verifikasi', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        // 6. Tabel Tiket Perbaikan
        Schema::create('tiket_perbaikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduan_masyarakat')->onDelete('cascade');
            $table->foreignId('aset_pju_id')->nullable()->constrained('aset_pju')->onDelete('set null');
            $table->foreignId('tim_lapangan_id')->nullable()->constrained('tim_lapangan');
            $table->date('tgl_jadwal')->nullable();
            $table->enum('prioritas', ['Biasa', 'Mendesak'])->default('Biasa');
            $table->enum('status_tindakan', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->boolean('perlu_surat_pln')->default(false);
            $table->timestamps();
        });

        // 7. Tabel Log Tindakan Teknisi
        Schema::create('log_tindakan_teknisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_perbaikan_id')->constrained('tiket_perbaikan')->onDelete('cascade');
            $table->text('hasil_cek')->nullable();
            $table->json('suku_cadang')->nullable(); // Simpan array suku cadang
            $table->string('foto_bukti_selesai')->nullable();
            $table->timestamps();
        });

        // 8. Sistem Foto Relasional (Polymorphic)
        Schema::create('foto_pju', function (Blueprint $table) {
            $table->id();
            $table->morphs('fotoable'); // Menghasilkan fotoable_id dan fotoable_type
            $table->string('path_foto');
            $table->string('keterangan')->nullable();
            $table->enum('kategori', ['Sebelum', 'Sesudah', 'Suku Cadang', 'Umum'])->default('Umum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_pju');
        Schema::dropIfExists('log_tindakan_teknisi');
        Schema::dropIfExists('tiket_perbaikan');
        Schema::dropIfExists('pengaduan_masyarakat');
        Schema::dropIfExists('log_survey');
        Schema::dropIfExists('progres_pengerjaan');
        Schema::dropIfExists('koneksi_pju_kwh');
        Schema::dropIfExists('aset_pju');
    }
};
