<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\ProgresPengerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgresPengerjaanController extends Controller
{
    public function index()
    {
        // 1. Ambil data progres (Grouped by aset agar tampil 1 row per aset)
        $progresRaw = ProgresPengerjaan::with(['asetPju', 'user'])
            ->orderBy('tgl_update', 'desc')
            ->get();

        $progresPengerjaan = $progresRaw->unique('aset_pju_id');

        // 2. LOGIKA BARU: Filter Aset untuk Dropdown Modal Tambah
        // Ambil semua ID aset_pju yang sudah ada di tabel progres_pengerjaan
        $usedAsetIds = ProgresPengerjaan::pluck('aset_pju_id')->toArray();

        // Hanya ambil Aset PJU yang ID-nya TIDAK ADA di daftar $usedAsetIds
        $listAset = AsetPju::whereNotIn('id', $usedAsetIds)
            ->orderBy('kode_tiang', 'asc')
            ->get();

        return view('progres-pengerjaan.index', compact('progresPengerjaan', 'listAset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_pju_id' => 'required|exists:aset_pju,id|unique:progres_pengerjaan,aset_pju_id', // Tambahan validasi unique biar aman
            'tahapan'     => 'required',
        ]);

        $aset = AsetPju::find($request->aset_pju_id);

        ProgresPengerjaan::create([
            'aset_pju_id'   => $request->aset_pju_id,
            'user_id'       => Auth::id(),
            'tahapan'       => $request->tahapan,
            'tgl_update'    => now(), 
            'keterangan'    => '-',
            'latitude_log'  => $aset->latitude,
            'longitude_log' => $aset->longitude,
        ]);

        return redirect()->back()->with('success', 'Progres pengerjaan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahapan' => 'required',
        ]);

        $progres = ProgresPengerjaan::findOrFail($id);

        $progres->update([
            'tahapan'    => $request->tahapan,
            'keterangan' => $request->keterangan,
            'tgl_update' => now(), // Update waktu
            'user_id'    => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Progres berhasil diperbarui');
    }

    public function show($asetPjuId)
    {
        $progresHistory = ProgresPengerjaan::where('aset_pju_id', $asetPjuId)
            ->with('user')
            ->orderBy('tgl_update', 'desc')
            ->get();

        $asetInfo = AsetPju::findOrFail($asetPjuId);

        return view('progres-pengerjaan.show', compact('progresHistory', 'asetInfo'));
    }
}