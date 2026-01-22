<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaduanMasyarakat;
use Illuminate\Support\Facades\Storage;

class AduanController extends Controller
{
    /**
     * HALAMAN PUBLIK: DAFTAR ADUAN
     */
    public function daftarAduan()
    {
        // Menampilkan hanya yang sudah diverifikasi (Diterima)
        $aduan = PengaduanMasyarakat::where('status_verifikasi', 'Diterima')
                    ->latest()
                    ->get();

        return view('daftar-aduan', compact('aduan'));
    }

    /**
     * HALAMAN PUBLIK: DETAIL ADUAN
     * Method baru untuk menampilkan detail
     */
    public function detail($id)
    {
        // Cari data berdasarkan ID, jika tidak ketemu akan 404
        $aduan = PengaduanMasyarakat::findOrFail($id);

        return view('detail-aduan', compact('aduan'));
    }

    /**
     * LIST ADUAN (ADMIN)
     */
    public function index()
    {
        $aduan = PengaduanMasyarakat::latest()->get();
        return view('aduan-admin.index', compact('aduan'));
    }

    /**
     * SIMPAN ADUAN (MASYARAKAT)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp'        => 'required|string|max:20',
            'tipe_aduan'   => 'required|in:lampu_mati,permohonan_pju_baru',
            'deskripsi'    => 'required|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $mapTipe = [
            'lampu_mati' => 'Lampu Mati',
            'permohonan_pju_baru' => 'Permohonan PJU Baru',
        ];

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aduan', 'public');
        }

        PengaduanMasyarakat::create([
            'nama_pelapor'      => $validated['nama_pelapor'],
            'no_hp'             => $validated['no_hp'],
            'tipe_aduan'        => $mapTipe[$validated['tipe_aduan']],
            'deskripsi_lokasi'  => $validated['deskripsi'],
            'latitude'          => $validated['latitude'],
            'longitude'         => $validated['longitude'],
            'foto_lapangan'     => $fotoPath,
            'status_verifikasi' => 'Pending',
        ]);

        return back()->with('success', 'Aduan berhasil dikirim.');
    }

    // ... (Method verifikasi, tolak, destroy tetap sama seperti sebelumnya) ...
    public function verifikasi(Request $request, $id)
    {
        $request->validate(['catatan_admin' => 'required|string']);
        $aduan = PengaduanMasyarakat::findOrFail($id);
        $aduan->update(['status_verifikasi' => 'Diterima', 'catatan_admin' => $request->catatan_admin]);
        return response()->json(['success' => true, 'message' => 'Aduan berhasil diverifikasi']);
    }

    public function tolak(Request $request, $id)
    {
        $request->validate(['catatan_admin' => 'required|string']);
        $aduan = PengaduanMasyarakat::findOrFail($id);
        $aduan->update(['status_verifikasi' => 'Ditolak', 'catatan_admin' => $request->catatan_admin]);
        return response()->json(['success' => true, 'message' => 'Aduan berhasil ditolak']);
    }

    public function destroy($id)
    {
        $aduan = PengaduanMasyarakat::findOrFail($id);
        if ($aduan->foto_lapangan && Storage::disk('public')->exists($aduan->foto_lapangan)) {
            Storage::disk('public')->delete($aduan->foto_lapangan);
        }
        $aduan->delete();
        return response()->json(['success' => true, 'message' => 'Aduan berhasil dihapus']);
    }
}