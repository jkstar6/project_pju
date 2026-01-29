<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TiketPerbaikan;        
use App\Models\PengaduanMasyarakat; 
use App\Models\TimLapangan; 
use App\Models\AsetPju;

class TiketPerbaikanController extends Controller
{
    public function index()
    {
        $tiketPerbaikan = TiketPerbaikan::with(['pengaduan', 'tim_lapangan'])
            ->orderByRaw("CASE WHEN status_tindakan = 'Selesai' THEN 1 ELSE 0 END ASC")
            ->latest() 
            ->get();

        // Ambil data untuk modal
        $tims = TimLapangan::all();
        $asets = AsetPju::all();

        return view('tiket-perbaikan.index', compact('tiketPerbaikan', 'tims', 'asets'));
    }

    public function getVerifiedAduan()
    {
        $aduan = PengaduanMasyarakat::where('status_verifikasi', 'Diterima')
            ->doesntHave('tiket')
            ->latest()
            ->get();

        return response()->json($aduan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id'    => 'required|exists:pengaduan_masyarakat,id',
            'tim_lapangan_id' => 'required|exists:tim_lapangan,id',
            'aset_pju_id'     => 'required|exists:aset_pju,id',
        ]);

        $tiket = TiketPerbaikan::create([
            'pengaduan_id'    => $request->pengaduan_id,
            'tim_lapangan_id' => $request->tim_lapangan_id,
            'aset_pju_id'     => $request->aset_pju_id,
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

    // ... method show, update, destroy tetap sama ...

    /**
     * SHOW: DETAIL TIKET
     */
    public function show($id)
    {
        // Load semua relasi yang diperlukan untuk halaman detail
        $tiket = TiketPerbaikan::with(['pengaduan', 'tim_lapangan', 'log_tindakan'])
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

        // Pastikan format boolean benar
        $perluSurat = filter_var($validated['perlu_surat_pln'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

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

    /**
     * DESTROY: HAPUS TIKET
     */
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