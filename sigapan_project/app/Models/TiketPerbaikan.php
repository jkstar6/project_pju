<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'tiket_perbaikan';

    protected $fillable = [
        'pengaduan_id',
        'aset_pju_id',
        'tim_lapangan_id',
        'tgl_jadwal',
        'prioritas',
        'status_tindakan',
        'perlu_surat_pln',
    ];

    /**
     * Relasi ke Pengaduan Masyarakat
     */
    public function pengaduan()
    {
        return $this->belongsTo(PengaduanMasyarakat::class, 'pengaduan_id');
    }

    /**
     * Relasi ke Tim Lapangan (Penyebab Error)
     */
    public function tim_lapangan()
    {
        return $this->belongsTo(TimLapangan::class, 'tim_lapangan_id');
    }

    /**
     * Relasi ke Aset PJU
     */
    public function aset_pju()
    {
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }

    // Tambahkan di dalam class TiketPerbaikan di app/Models/TiketPerbaikan.php
    public function log_tindakan()
    {
        // Sesuaikan nama model LogTindakan Anda jika berbeda
        return $this->hasMany(TindakanTeknisi::class, 'tiket_perbaikan_id');
    }   

    // app/Models/TiketPerbaikan.php

    public function aset()
    {
        // Pastikan foreign key di tabel tiket_perbaikan adalah 'aset_pju_id'
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }
}