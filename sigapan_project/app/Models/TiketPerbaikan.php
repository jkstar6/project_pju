<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'tiket_perbaikan';

    // Kita tetap masukkan foreign key di sini agar Create/Update di Controller berjalan lancar
    protected $fillable = [
        'pengaduan_id',
        'aset_pju_id',      // Tetap ada di database meski modelnya belum ada
        'tim_lapangan_id',  // Tetap ada di database meski modelnya belum ada
        'tgl_jadwal',
        'prioritas',
        'status_tindakan',
        'perlu_surat_pln',
    ];

    /**
     * RELASI UTAMA
     * Hanya relasi ini yang kita aktifkan karena Model PengaduanMasyarakat sudah ada.
     */
    public function pengaduan()
    {
        return $this->belongsTo(PengaduanMasyarakat::class, 'pengaduan_id');
    }


    // Relasi ke Aset PJU (Ini yang menyebabkan error jika tidak ada)
    public function aset()
    {
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }
    // Relasi ke TimLapangan, AsetPju, dll DIHAPUS DULU agar tidak error.
}