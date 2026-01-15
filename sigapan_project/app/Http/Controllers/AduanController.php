<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AduanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'tipe_aduan' => 'required|in:lampu_mati,permohonan_pju_baru',

            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // sementara belum simpan DB
        return back()->with('success', 'Aduan berhasil dikirim!');
    }
}
