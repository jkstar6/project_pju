<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\ProgresPengerjaan;
use App\Models\User; // ✅ 1. Jangan lupa import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgresPengerjaanController extends Controller
{
    public function index()
    {
        // 1. Ambil data progres
        $progresRaw = ProgresPengerjaan::with(['asetPju', 'user'])
            ->orderBy('tgl_update', 'desc')
            ->get();

        $progresPengerjaan = $progresRaw->unique('aset_pju_id');

        // 2. Filter Aset untuk Dropdown Modal Tambah
        $usedAsetIds = ProgresPengerjaan::pluck('aset_pju_id')->toArray();
        $listAset = AsetPju::whereNotIn('id', $usedAsetIds)
            ->orderBy('kode_tiang', 'asc')
            ->get();

        // ✅ 3. AMBIL DATA TEKNISI (Menggunakan Spatie Scope)
        // Fungsi role('Teknisi') otomatis memfilter user yang punya role tersebut.
        // Kita juga filter agar hanya user aktif yang muncul.
        $listTeknisi = User::role('Teknisi')
            ->where('is_active', 1) 
            ->orderBy('name', 'asc')
            ->get();

        // ✅ 4. Kirim variabel $listTeknisi ke view
        return view('progres-pengerjaan.index', compact('progresPengerjaan', 'listAset', 'listTeknisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_pju_id' => 'required|exists:aset_pju,id|unique:progres_pengerjaan,aset_pju_id',
            'user_id'     => 'required|exists:users,id', // ✅ Validasi input petugas
            'tahapan'     => 'required',
        ]);

        $aset = AsetPju::find($request->aset_pju_id);

        ProgresPengerjaan::create([
            'aset_pju_id'   => $request->aset_pju_id,
            'user_id'       => $request->user_id, // ✅ Simpan ID petugas yang DIPILIH (Bukan Auth::id())
            'tahapan'       => $request->tahapan,
            'tgl_update'    => now(), 
            'keterangan'    => '-',
            'latitude_log'  => $aset->latitude,
            'longitude_log' => $aset->longitude,
        ]);

        return redirect()->back()->with('success', 'Progres pengerjaan berhasil ditambahkan');
    }

    // Method update & show tetap sama...
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahapan' => 'required',
        ]);

        $progres = ProgresPengerjaan::findOrFail($id);

        $progres->update([
            'tahapan'    => $request->tahapan,
            'keterangan' => $request->keterangan,
            'tgl_update' => now(),
            'user_id'    => Auth::id(), // Kalau update, biasanya tercatat siapa yang login terakhir mengupdate
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