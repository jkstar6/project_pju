<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelKwh extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'panel_kwh';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'no_pelanggan_pln',
        'lokasi_panel',
        'latitude',
        'longitude',
        'daya_va',
        'catatan_admin_pln',
    ];
}