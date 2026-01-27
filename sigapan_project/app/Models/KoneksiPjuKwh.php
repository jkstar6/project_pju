<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoneksiPjuKwh extends Model
{
    protected $table = 'koneksi_pju_kwh';

    protected $fillable = [
        'aset_pju_id',
        'panel_kwh_id',
        'nomor_mcb_panel',
        'fasa',
        'status_koneksi',
        'tgl_koneksi',
        'panjang_kabel_est',
        'keterangan_jalur',
    ];

    public function asetPju()
    {
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }

    public function panelKwh()
    {
        return $this->belongsTo(PanelKwh::class, 'panel_kwh_id');
    }
}
