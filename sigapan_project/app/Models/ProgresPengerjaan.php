<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresPengerjaan extends Model
{
    protected $table = 'progres_pengerjaan';
    
    // Matikan timestamps default (created_at, updated_at) jika tabel tidak memilikinya
    // Sesuai migrasi Anda, hanya ada 'tgl_update'. 
    // Jika ingin pakai timestamps laravel, pastikan kolomnya ada.
    // Di sini kita manual handle tgl_update.
    public $timestamps = false;

    protected $fillable = [
        'aset_pju_id',
        'user_id',
        'tahapan',
        'tgl_update',
        'keterangan',
        'latitude_log',
        'longitude_log',
    ];

    // Relasi ke Aset PJU
    public function asetPju()
    {
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }

    // Relasi ke User (Petugas)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}