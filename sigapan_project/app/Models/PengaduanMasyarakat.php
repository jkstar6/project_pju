<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanMasyarakat extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_masyarakat';

    protected $fillable = [
        'nama_pelapor',
        'no_hp',
        'tipe_aduan',
        'deskripsi_lokasi',
        'latitude',
        'longitude',
        'foto_lapangan',
        'status_verifikasi',
        'catatan_admin',
    ];
}
