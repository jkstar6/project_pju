<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AduanController extends Controller
{
    /**
     * MOCKUP DATA PENGADUAN (ADMIN)
     */
    public function index()
    {
        $aduan = [
            (object) [
                'id' => 1,
                'nama_pelapor' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'tipe_aduan' => 'Lampu Mati',
                'deskripsi_lokasi' => 'Jl. Mawar RT 03 RW 01, dekat mushola',
                'latitude' => -7.795580,
                'longitude' => 110.369490,
                'foto_lapangan' => 'lampu_mati_1.jpg',
                'status_verifikasi' => 'Pending',
                'catatan_admin' => null,
                'created_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 2,
                'nama_pelapor' => 'Siti Aminah',
                'no_hp' => '082345678901',
                'tipe_aduan' => 'Permohonan PJU Baru',
                'deskripsi_lokasi' => 'Jl. Melati, area persawahan gelap',
                'latitude' => -7.801200,
                'longitude' => 110.360120,
                'foto_lapangan' => 'pju_baru_1.jpg',
                'status_verifikasi' => 'Diterima',
                'catatan_admin' => 'Akan dijadwalkan pemasangan',
                'created_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 3,
                'nama_pelapor' => 'Ahmad Dani',
                'no_hp' => '083456789012',
                'tipe_aduan' => 'Lampu Mati',
                'deskripsi_lokasi' => 'Depan pasar tradisional',
                'latitude' => -7.790100,
                'longitude' => 110.375880,
                'foto_lapangan' => null,
                'status_verifikasi' => 'Ditolak',
                'catatan_admin' => 'Lampu masih berfungsi normal',
                'created_at' => now()->subDays(5),
            ],
        ];

        return view('aduan-admin.index', compact('aduan'));
    }

    /**
     * SIMPAN ADUAN (MASIH MOCK)
     */
    public function store(Request $request)
    {
        return back()->with('success', 'Aduan berhasil dikirim (mockup).');
    }
}
