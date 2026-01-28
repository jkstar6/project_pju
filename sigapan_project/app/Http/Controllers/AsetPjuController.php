<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\PanelKwh;
use Illuminate\Http\Request;

class AsetPjuController extends Controller
{
    public function index()
    {
        $asetPju = AsetPju::orderBy('created_at', 'desc')->get();

        // Kirim panel untuk dropdown
        $panelKwh = PanelKwh::select('id','no_pelanggan_pln','daya_va','latitude','longitude','lokasi_panel')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('aset-pju.index', compact('asetPju', 'panelKwh'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'panel_kwh_id' => 'required|exists:panel_kwh,id', // sesuaikan nama tabel kalau beda
            'jalan_id'     => 'nullable',
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang',
            'jenis_lampu'  => 'nullable|string',
            'watt'         => 'nullable|numeric',
            'status_aset'  => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'desa'         => 'nullable|string',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        AsetPju::create([
            'panel_kwh_id' => $panel->id,
            'jalan_id'     => $request->jalan_id,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset ?? 'Usulan',
            'warna_map'    => 'Kuning',

            // lokasi terkunci ikut panel
            'latitude'     => $panel->latitude,
            'longitude'    => $panel->longitude,

            'kecamatan'    => $request->kecamatan,
            'desa'         => $request->desa,
        ]);

        return redirect()
            ->route('aset-pju.index')
            ->with('success', 'Aset PJU berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $aset = AsetPju::findOrFail($id);

        $request->validate([
            'panel_kwh_id' => 'required|exists:panel_kwh,id',
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang,' . $aset->id,
            'jenis_lampu'  => 'nullable|string',
            'watt'         => 'nullable|numeric',
            'status_aset'  => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'desa'         => 'nullable|string',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        $aset->update([
            'panel_kwh_id' => $panel->id,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset ?? $aset->status_aset,

            // lokasi terkunci ikut panel
            'latitude'     => $panel->latitude,
            'longitude'    => $panel->longitude,

            'kecamatan'    => $request->kecamatan,
            'desa'         => $request->desa,
        ]);

        return redirect()
            ->route('aset-pju.index')
            ->with('success', 'Aset PJU berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aset = AsetPju::findOrFail($id);
        $aset->delete();

        return redirect()
            ->route('aset-pju.index')
            ->with('success', 'Aset PJU berhasil dihapus');
    }
}
