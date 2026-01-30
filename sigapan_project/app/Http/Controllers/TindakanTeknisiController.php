<?php

namespace App\Http\Controllers;

use App\Models\TindakanTeknisi;
use App\Models\TiketPerbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TindakanTeknisiController extends Controller
{
    /**
     * Menampilkan daftar log tindakan teknisi.
     */
    public function index()
    {
        // Mengambil log tindakan dengan relasi tiket, aset, dan pengaduan
        $tindakan = TindakanTeknisi::with(['tiket.aset', 'tiket.pengaduan'])->latest()->get();

        // Mengambil tiket yang masih aktif (Menunggu atau Proses) untuk dropdown input baru
        $tikets = TiketPerbaikan::with(['aset', 'pengaduan'])
            ->whereIn('status_tindakan', ['Menunggu', 'Proses']) 
            ->get();

        return view('tindakan-teknisi.index', compact('tindakan', 'tikets'));
    }

    /**
     * Menyimpan tindakan baru (Status otomatis ke 'Proses').
     */
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

                // 1. Membersihkan data suku cadang dari baris kosong
                if ($request->has('suku_cadang')) {
                    $data['suku_cadang'] = array_values(array_filter($request->suku_cadang, function ($item) {
                        return !empty($item['nama']);
                    }));
                }

                // 2. Simpan Foto Bukti jika ada
                if ($request->hasFile('foto_bukti_selesai')) {
                    $data['foto_bukti_selesai'] = $request->file('foto_bukti_selesai')->store('tindakan', 'public');
                }

                // 3. Simpan data tindakan teknisi
                TindakanTeknisi::create($data);

                // 4. Update status tiket perbaikan menjadi 'Proses'
                TiketPerbaikan::where('id', $request->tiket_perbaikan_id)
                    ->update(['status_tindakan' => 'Proses']);
            });

            return redirect()->back()->with('success', 'Tindakan berhasil dicatat. Status tiket kini: Proses.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Memperbarui data tindakan dan sinkronisasi status ke tiket perbaikan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hasil_cek' => 'required|string',
            'status' => 'required|in:Proses,Selesai', // Validasi input status dari modal edit
            'foto_bukti_selesai' => 'nullable|image|max:2048',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $tindakan = TindakanTeknisi::findOrFail($id);
                $data = $request->all();

                // 1. Membersihkan data suku cadang
                if ($request->has('suku_cadang')) {
                    $data['suku_cadang'] = array_values(array_filter($request->suku_cadang, function ($item) {
                        return !empty($item['nama']);
                    }));
                }

                // 2. Update Foto (Hapus foto lama jika ada upload baru)
                if ($request->hasFile('foto_bukti_selesai')) {
                    if ($tindakan->foto_bukti_selesai) {
                        Storage::disk('public')->delete($tindakan->foto_bukti_selesai);
                    }
                    $data['foto_bukti_selesai'] = $request->file('foto_bukti_selesai')->store('tindakan', 'public');
                }

                // 3. Update data di tabel tindakan_teknisi
                $tindakan->update($data);

                // 4. SINKRONISASI STATUS: Update status di tabel TiketPerbaikan
                TiketPerbaikan::where('id', $tindakan->tiket_perbaikan_id)
                    ->update(['status_tindakan' => $request->status]);
            });

            return redirect()->back()->with('success', 'Data tindakan dan status tiket berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus log tindakan.
     */
    public function destroy($id)
    {
        try {
            $item = TindakanTeknisi::findOrFail($id);
            
            // Hapus file fisik foto jika ada
            if ($item->foto_bukti_selesai) {
                Storage::disk('public')->delete($item->foto_bukti_selesai);
            }
            
            $item->delete();
            return redirect()->back()->with('success', 'Log tindakan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }
}