<?php

namespace App\Http\Controllers;

use App\Models\TimLapangan;
use App\Models\User; // Pastikan model User diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TimLapanganController extends Controller
{
    /**
     * Menampilkan daftar tim lapangan.
     */
    public function index()
    {
        // Ambil data tim beserta data leadernya (eager loading)
        $timLapangan = TimLapangan::with('leader')->latest()->get();
        
        // Ambil data user untuk dropdown "Ketua Tim" di Modal Tambah/Edit
        // Sesuaikan filter jika hanya user tertentu yang boleh jadi ketua
        $users = User::orderBy('name', 'asc')->get();

        return view('tim-lapangan.index', compact('timLapangan', 'users'));
    }

    /**
     * Menyimpan data tim baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tim'        => 'required|string|max:50',
            'kategori'        => 'required|in:Teknisi,Surveyor',
            'leader_id'       => 'nullable|exists:users,id',
            'jumlah_personel' => 'required|integer|min:1',
        ]);

        try {
            TimLapangan::create($request->all());

            return redirect()->route('tim-lapangan.index')
                ->with('success', 'Tim lapangan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Mengambil data single untuk Modal Edit (AJAX).
     */
    public function edit($id)
    {
        $tim = TimLapangan::findOrFail($id);
        return response()->json($tim);
    }

    /**
     * Mengupdate data tim.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tim'        => 'required|string|max:50',
            'kategori'        => 'required|in:Teknisi,Surveyor',
            'leader_id'       => 'nullable|exists:users,id',
            'jumlah_personel' => 'required|integer|min:1',
        ]);

        try {
            $tim = TimLapangan::findOrFail($id);
            $tim->update($request->all());

            return redirect()->route('tim-lapangan.index')
                ->with('success', 'Tim lapangan berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data tim.
     */
    public function destroy($id)
    {
        try {
            $tim = TimLapangan::findOrFail($id);
            $tim->delete();

            return redirect()->route('tim-lapangan.index')
                ->with('success', 'Tim lapangan berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}