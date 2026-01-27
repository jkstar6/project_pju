<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use Illuminate\Http\Request;

class AsetPjuController extends Controller
{
    /**
     * Tampilkan daftar aset PJU
     */
    public function index()
    {
        $asetPju = AsetPju::orderBy('created_at', 'desc')->get();

        return view('aset-pju.index', compact('asetPju'));
    }

    /**
     * Simpan data aset PJU
     */
    public function store(Request $request)
    {
        $request->validate([
            'panel_kwh_id' => 'nullable',
            'jalan_id'     => 'nullable',
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang',
            'latitude'     => 'required',
            'longitude'    => 'required',
        ]);

        AsetPju::create([
            'panel_kwh_id' => null,
            'jalan_id'     => null,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset ?? 'Usulan',
            'warna_map'    => 'Kuning',
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'kecamatan'    => $request->kecamatan,
            'desa'         => $request->desa,
        ]);

        return redirect()
            ->route('admin.aset-pju.index')
            ->with('success', 'Aset PJU berhasil disimpan');
    }

    public function destroy($id)
    {
        $aset = AsetPju::findOrFail($id);
        $aset->delete();

        return redirect()
            ->route('admin.aset-pju.index')
            ->with('success', 'Aset PJU berhasil dihapus');
    }

}
