<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimLapangan extends Model
{
    use HasFactory;

    protected $table = 'tim_lapangan';

    protected $fillable = [
        'nama_tim',
        'kategori',
        'leader_id',
        'jumlah_personel',
    ];

    /**
     * Relasi ke tabel Users untuk Ketua Tim (Leader).
     */
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}