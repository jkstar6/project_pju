<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\ProgresPengerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgresPengerjaanController extends Controller
{
    public function index()
    {
        $progresRaw = ProgresPengerjaan::with(['asetPju', 'user'])
            ->orderBy('tgl_update', 'desc')
            ->get();

        $progresPengerjaan = $progresRaw->unique('aset_pju_id');

        $usedAsetIds = ProgresPengerjaan::pluck('aset_pju_id')->toArray();
        $listAset = AsetPju::whereNotIn('id', $usedAsetIds)
            ->orderBy('kode_tiang', 'asc')
            ->get();

        // Ambil User dengan Role Teknisi
        $listTeknisi = User::role('Teknisi')
            ->where('is_active', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('progres-pengerjaan.index', compact('progresPengerjaan', 'listAset', 'listTeknisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_pju_id' => 'required|exists:aset_pju,id|unique:progres_pengerjaan,aset_pju_id',
            'user_id'     => 'required|exists:users,id',
            'tahapan'     => 'required',
        ]);

        $aset = AsetPju::find($request->aset_pju_id);

        ProgresPengerjaan::create([
            'aset_pju_id'   => $request->aset_pju_id,
            'user_id'       => $request->user_id, // ✅ Simpan Petugas yang dipilih dari dropdown
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

        // ✅ PERBAIKAN UTAMA DI SINI
        // Kita HAPUS 'user_id' => Auth::id() agar petugas tidak berubah jadi admin yang login.
        // Kita HAPUS update user_id sepenuhnya agar data petugas asli tetap terjaga.
        
        $progres->update([
            'tahapan'    => $request->tahapan,
            'keterangan' => $request->keterangan,
            'tgl_update' => now(),
            // 'user_id' => Auth::id(), // ❌ JANGAN PAKAI INI (Ini penyebab errornya)
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
   public function destroy($id)
{
    $progres = ProgresPengerjaan::findOrFail($id);
    $progres->delete();

    return redirect()->back()->with('success', 'Data progres berhasil dihapus');
}
}