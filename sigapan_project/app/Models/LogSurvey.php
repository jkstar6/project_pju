<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSurvey extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'log_survey';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'aset_pju_id',
        'user_id',
        'tgl_survey',
        'kondisi',
        'keberadaan',
        'lat_input',
        'long_input',
        'catatan_kerusakan',
    ];

    /**
     * Relasi ke model AsetPju
     * Log survey ini dimiliki oleh satu aset PJU
     */
    public function aset()
    {
        return $this->belongsTo(AsetPju::class, 'aset_pju_id');
    }

    /**
     * Relasi ke model User (Surveyor)
     * Log survey ini dibuat oleh satu user/surveyor
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}