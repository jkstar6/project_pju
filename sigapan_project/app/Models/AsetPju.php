<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterJalan;
use App\Models\PanelKwh;

class AsetPju extends Model
{
    protected $table = 'aset_pju';

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

    public function jalan()
    {
        return $this->belongsTo(MasterJalan::class, 'jalan_id');
    }

    public function panelKwh()
    {
        return $this->belongsTo(PanelKwh::class, 'panel_kwh_id');
    }
}
