<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetPju extends Model
{
    protected $table = 'aset_pju'; // ⬅️ WAJIB

    protected $fillable = [
        'panel_kwh_id',
        'jalan_id',
        'kode_tiang',
        'jenis_lampu',
        'watt',
        'status_aset',
        'warna_map',
        'latitude',
        'longitude',
        'kecamatan',
        'desa',
    ];
}
