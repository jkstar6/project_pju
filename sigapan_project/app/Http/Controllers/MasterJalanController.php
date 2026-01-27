<?php

namespace App\Http\Controllers;

use App\Models\MasterJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MasterJalanController extends Controller
{
    /**
     * Menampilkan daftar jalan.
     */
    public function index()
    {
        // Ambil data terbaru dari database
        $jalan = MasterJalan::latest()->get();
        return view('master-jalan.index', compact('jalan'));
    }

    /**
     * Simpan data jalan baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jalan'      => 'required|string|max:255',
            'kategori_jalan'  => 'required|in:Nasional,Provinsi,Kabupaten,Desa,Lingkungan',
            'lebar_jalan'     => 'required|numeric|min:0',
            'panjang_jalan'   => 'required|numeric|min:0',
            'tipe_perkerasan' => 'required|in:Aspal,Beton,Paving,Tanah',
        ]);

        try {
            DB::beginTransaction();

            // Create data (Nama input view sudah disamakan dengan kolom DB)
            MasterJalan::create($request->all());

            DB::commit();

            return redirect()->route('master-jalan.index')
                ->with('success', 'Data jalan berhasil ditambahkan.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update data jalan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalan'      => 'required|string|max:255',
            'kategori_jalan'  => 'required|in:Nasional,Provinsi,Kabupaten,Desa,Lingkungan',
            'lebar_jalan'     => 'required|numeric|min:0',
            'panjang_jalan'   => 'required|numeric|min:0',
            'tipe_perkerasan' => 'required|in:Aspal,Beton,Paving,Tanah',
        ]);

        try {
            DB::beginTransaction();

            $jalan = MasterJalan::findOrFail($id);
            $jalan->update($request->all());

            DB::commit();

            return redirect()->route('master-jalan.index')
                ->with('success', 'Data jalan berhasil diperbarui.');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }
}