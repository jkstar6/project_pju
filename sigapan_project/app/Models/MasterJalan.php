<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJalan extends Model
{
    use HasFactory;

    // Nama tabel sesuai migration
    protected $table = 'master_jalan';

    // Kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'nama_jalan',
        'kategori_jalan',   // Enum: Nasional, Provinsi, Kabupaten, Desa, Lingkungan
        'lebar_jalan',      // Decimal
        'panjang_jalan',    // Decimal
        'tipe_perkerasan',  // Enum: Aspal, Beton, Paving, Tanah
    ];

    // Casting tipe data agar output JSON/View sesuai format
    protected $casts = [
        'lebar_jalan' => 'float',
        'panjang_jalan' => 'float',
    ];
}