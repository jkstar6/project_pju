<?php

namespace App\Http\Controllers;

use App\Models\TindakanTeknisi;
use App\Models\TiketPerbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TindakanTeknisiController extends Controller
{
    public function index()
    {
        // Mengambil log tindakan yang sudah ada
        $tindakan = TindakanTeknisi::with(['tiket.aset', 'tiket.pengaduan'])->latest()->get();

        // Hanya mengambil tiket yang statusnya BELUM selesai agar muncul di dropdown
        $tikets = TiketPerbaikan::with(['aset', 'pengaduan'])
            ->whereIn('status_tindakan', ['Menunggu', 'Proses']) 
            ->get();

        return view('tindakan-teknisi.index', compact('tindakan', 'tikets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiket_perbaikan_id' => 'required|exists:tiket_perbaikan,id',
            'hasil_cek' => 'required|string',
            'foto_bukti_selesai' => 'nullable|image|max:2048',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $data = $request->all();

                // Bersihkan data suku cadang yang kosong
                if ($request->has('suku_cadang')) {
                    $data['suku_cadang'] = array_values(array_filter($request->suku_cadang, function ($item) {
                        return !empty($item['nama']);
                    }));
                }

                // Simpan Foto Bukti
                if ($request->hasFile('foto_bukti_selesai')) {
                    $data['foto_bukti_selesai'] = $request->file('foto_bukti_selesai')->store('tindakan', 'public');
                }

                // 1. Simpan data tindakan teknisi
                TindakanTeknisi::create($data);

                // 2. OTOMATIS SELESAI: Update status tiket perbaikan
                TiketPerbaikan::where('id', $request->tiket_perbaikan_id)
                    ->update(['status_tindakan' => 'Selesai']);
            });

            return redirect()->back()->with('success', 'Laporan berhasil disimpan dan Tiket otomatis ditandai SELESAI.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Fungsi Destroy untuk hapus log
    public function destroy($id)
    {
        $item = TindakanTeknisi::findOrFail($id);
        if ($item->foto_bukti_selesai) {
            Storage::disk('public')->delete($item->foto_bukti_selesai);
        }
        $item->delete();
        return redirect()->back()->with('success', 'Log tindakan berhasil dihapus.');
    }
}