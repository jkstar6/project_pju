<?php

namespace App\Http\Controllers;

use App\Models\PanelKwh;
use Illuminate\Http\Request;

class PanelKwhController extends Controller
{
    /**
     * Tampilkan daftar Panel KWh
     */
    public function index()
    {
        $panelKwh = PanelKwh::orderBy('created_at', 'desc')->get();

        return view('panel-kwh.index', compact('panelKwh'));
    }

    /**
     * Simpan data Panel KWh
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pelanggan_pln'  => 'required|string|unique:panel_kwh,no_pelanggan_pln',
            'daya_va'           => 'nullable|numeric',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric',
            'lokasi_panel'      => 'required|string',
            'catatan_admin_pln' => 'nullable|string',
        ]);

        PanelKwh::create([
            'no_pelanggan_pln'  => $request->no_pelanggan_pln,
            'daya_va'           => $request->daya_va ?? 1300,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'lokasi_panel'      => $request->lokasi_panel,
            'catatan_admin_pln' => $request->catatan_admin_pln,
        ]);

        return redirect()
            ->route('panel-kwh.index')
            ->with('success', 'Panel KWh berhasil disimpan');
    }

    /**
     * Update data Panel KWh
     * Route kamu: PUT /panel-kwh/{id}
     */
    public function update(Request $request, $id)
    {
        $panel = PanelKwh::findOrFail($id);

        $request->validate([
            'no_pelanggan_pln'  => 'required|string|unique:panel_kwh,no_pelanggan_pln,' . $panel->id,
            'daya_va'           => 'nullable|numeric',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric',
            'lokasi_panel'      => 'required|string',
            'catatan_admin_pln' => 'nullable|string',
        ]);

        $panel->update([
            'no_pelanggan_pln'  => $request->no_pelanggan_pln,
            'daya_va'           => $request->daya_va ?? 1300,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'lokasi_panel'      => $request->lokasi_panel,
            'catatan_admin_pln' => $request->catatan_admin_pln,
        ]);

        return redirect()
            ->route('panel-kwh.index')
            ->with('success', 'Panel KWh berhasil diperbarui');
    }

    /**
     * Hapus data Panel KWh
     * Route kamu: DELETE /panel-kwh/{id}
     */
    public function destroy($id)
    {
        $panel = PanelKwh::findOrFail($id);
        $panel->delete();

        return redirect()
            ->route('panel-kwh.index')
            ->with('success', 'Panel KWh berhasil dihapus');
    }
}
