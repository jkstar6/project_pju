<?php

namespace App\Http\Controllers;

use App\Models\TimLapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class TimLapanganController extends Controller
{
    public function index()
    {
        $timLapangan = TimLapangan::with('leader')->latest()->get();
        
        // AMBIL DATA USER (Spatie Role)
        // Pastikan nama role di database (misal: 'Teknisi' & 'Survey') sesuai
        $users = User::role(['Teknisi', 'Survey']) 
                     ->get()
                     ->map(function($user) {
                         // Mapping: Jika role di DB 'Survey', ubah label jadi 'Surveyor'
                         $roleLabel = $user->hasRole('Survey') ? 'Surveyor' : 'Teknisi';
                         return [
                             'id' => $user->id,
                             'name' => $user->name,
                             'role' => $roleLabel // Ini yang dibaca JS
                         ];
                     });

        return view('tim-lapangan.index', compact('timLapangan', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tim'        => 'required|string|max:50',
            'kategori'        => 'required|in:Teknisi,Surveyor',
            // PERBAIKAN: Ubah nullable jadi required
            'leader_id'       => 'required|exists:users,id', 
            'jumlah_personel' => 'required|integer|min:1',
        ], [
            // Custom pesan error (opsional)
            'leader_id.required' => 'Ketua Tim wajib dipilih.',
        ]);

        try {
            TimLapangan::create($request->all());
            return redirect()->route('tim-lapangan.index')->with('success', 'Tim berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tim = TimLapangan::findOrFail($id);
        return response()->json($tim);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tim'        => 'required|string|max:50',
            'kategori'        => 'required|in:Teknisi,Surveyor',
            // PERBAIKAN: Ubah nullable jadi required
            'leader_id'       => 'required|exists:users,id',
            'jumlah_personel' => 'required|integer|min:1',
        ], [
            'leader_id.required' => 'Ketua Tim wajib dipilih.',
        ]);

        try {
            $tim = TimLapangan::findOrFail($id);
            $tim->update($request->all());
            return redirect()->route('tim-lapangan.index')->with('success', 'Tim berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $tim = TimLapangan::findOrFail($id);
            $tim->delete();
            return redirect()->route('tim-lapangan.index')->with('success', 'Tim berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}