<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TiketPerbaikan;        
use App\Models\PengaduanMasyarakat;   

class TiketPerbaikanController extends Controller
{
    /**
     * HALAMAN UTAMA (LIST TIKET)
     */
    public function index()
    {
        $tiketPerbaikan = TiketPerbaikan::with(['pengaduan'])
            // ✅ PERBAIKAN SORTING:
            // 1. Prioritaskan status: Yang bukan 'Selesai' (0) di atas, 'Selesai' (1) di bawah.
            ->orderByRaw("CASE WHEN status_tindakan = 'Selesai' THEN 1 ELSE 0 END ASC")
            // 2. Setelah dikelompokkan status, urutkan berdasarkan yang terbaru dibuat
            ->latest() 
            ->get();

        return view('tiket-perbaikan.index', compact('tiketPerbaikan'));
    }

    /**
     * API: AMBIL DAFTAR ADUAN VERIFIED (UNTUK MODAL CREATE)
     */
    public function getVerifiedAduan()
    {
        $aduan = PengaduanMasyarakat::where('status_verifikasi', 'Diterima')
            ->doesntHave('tiket')
            ->latest()
            ->get();

        return response()->json($aduan);
    }

    /**
     * STORE: MEMBUAT TIKET BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan_masyarakat,id',
        ]);

        $tiket = TiketPerbaikan::create([
            'pengaduan_id'    => $request->pengaduan_id,
            'tgl_jadwal'      => Carbon::now()->toDateString(),
            'prioritas'       => 'Biasa',
            'status_tindakan' => 'Menunggu',
            'perlu_surat_pln' => 0,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Tiket perbaikan berhasil dibuat.',
            'data'    => $tiket
        ]);
    }

    /**
     * SHOW: DETAIL TIKET
     */
    public function show($id)
    {
        $tiket = TiketPerbaikan::with(['pengaduan'])
            ->findOrFail($id);
        
        return view('tiket-perbaikan.show', compact('tiket'));
    }

    /**
     * UPDATE: MENGUBAH DATA TIKET (EDIT VIA MODAL)
     */
    public function update(Request $request, $id)
    {
        $tiket = TiketPerbaikan::findOrFail($id);

        $validated = $request->validate([
            'tgl_jadwal'      => 'nullable|date',
            'prioritas'       => 'required|in:Biasa,Mendesak',
            'status_tindakan' => 'required|in:Menunggu,Proses,Selesai',
            'perlu_surat_pln' => 'required',
        ]);

        $perluSurat = filter_var($validated['perlu_surat_pln'], FILTER_VALIDATE_BOOLEAN);

        $tiket->update([
            'tgl_jadwal'      => $validated['tgl_jadwal'],
            'prioritas'       => $validated['prioritas'],
            'status_tindakan' => $validated['status_tindakan'],
            'perlu_surat_pln' => $perluSurat,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Tiket perbaikan berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $tiket = TiketPerbaikan::findOrFail($id);
        $tiket->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Tiket berhasil dihapus.'
        ]);
    }
}