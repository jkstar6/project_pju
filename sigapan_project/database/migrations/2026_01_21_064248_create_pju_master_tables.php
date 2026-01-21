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
        // 1. Tabel Tim Lapangan (Dibuat dulu tanpa FK ke users)
        Schema::create('tim_lapangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tim', 50);
            $table->enum('kategori', ['Teknisi', 'Surveyor']);
            $table->unsignedBigInteger('leader_id')->nullable(); // Akan dihubungkan nanti
            $table->integer('jumlah_personel')->default(0);
            $table->timestamps();
        });

        // 2. Tabel Master Jalan
        Schema::create('master_jalan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalan');
            $table->enum('kategori_jalan', ['Nasional', 'Provinsi', 'Kabupaten', 'Desa', 'Lingkungan'])->default('Kabupaten');
            $table->decimal('lebar_jalan', 4, 2)->nullable();
            $table->decimal('panjang_jalan', 8, 2)->nullable();
            $table->enum('tipe_perkerasan', ['Aspal', 'Beton', 'Paving', 'Tanah'])->default('Aspal');
            $table->timestamps();
        });

        // 3. Tabel Panel KWH
        Schema::create('panel_kwh', function (Blueprint $table) {
            $table->id();
            $table->string('no_pelanggan_pln', 50)->unique();
            $table->text('lokasi_panel');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->integer('daya_va')->nullable();
            $table->text('catatan_admin_pln')->nullable();
            $table->timestamps();
        });

        // --- SOLUSI CIRCULAR REFERENCE ---

        // Menghubungkan users ke tim_lapangan
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_tim')->references('id')->on('tim_lapangan')->onDelete('set null');
        });

        // Menghubungkan tim_lapangan ke users (untuk Leader)
        Schema::table('tim_lapangan', function (Blueprint $table) {
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Melepas foreign key terlebih dahulu sebelum drop tabel
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_tim']);
        });

        Schema::table('tim_lapangan', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
        });

        Schema::dropIfExists('panel_kwh');
        Schema::dropIfExists('master_jalan');
        Schema::dropIfExists('tim_lapangan');
    }
};