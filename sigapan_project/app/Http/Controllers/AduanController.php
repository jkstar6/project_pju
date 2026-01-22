<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaduanMasyarakat;

class AduanController extends Controller
{
    /**
     * LIST ADUAN (ADMIN)
     */
    public function index()
    {
        $aduan = PengaduanMasyarakat::latest()->get();
        return view('aduan-admin.index', compact('aduan'));
    }

    /**
     * SIMPAN ADUAN (DATABASE)
     */
    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp'        => 'required|string|max:20',
            'tipe_aduan'   => 'required|in:lampu_mati,permohonan_pju_baru',
            'deskripsi'    => 'required|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // KONVERSI TIPE ADUAN → ENUM DATABASE
        $mapTipe = [
            'lampu_mati' => 'Lampu Mati',
            'permohonan_pju_baru' => 'Permohonan PJU Baru',
        ];

        // UPLOAD FOTO
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aduan', 'public');
        }

        // SIMPAN KE DATABASE
        PengaduanMasyarakat::create([
            'nama_pelapor'     => $validated['nama_pelapor'],
            'no_hp'            => $validated['no_hp'],
            'tipe_aduan'       => $mapTipe[$validated['tipe_aduan']],
            'deskripsi_lokasi' => $validated['deskripsi'],
            'latitude'         => $validated['latitude'],
            'longitude'        => $validated['longitude'],
            'foto_lapangan'    => $fotoPath,
            'status_verifikasi'=> 'Pending',
        ]);

        return back()->with('success', 'Aduan berhasil dikirim.');
    }
}
