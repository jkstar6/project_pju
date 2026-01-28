<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakanTeknisi extends Model
{
    protected $table = 'log_tindakan_teknisi';

    protected $fillable = [
        'tiket_perbaikan_id',
        'hasil_cek',
        'suku_cadang',
        'foto_bukti_selesai'
    ];

    protected $casts = [
        'suku_cadang' => 'array', // Otomatis Encode/Decode JSON
    ];

    public function tiket()
    {
        return $this->belongsTo(TiketPerbaikan::class, 'tiket_perbaikan_id');
    }
}