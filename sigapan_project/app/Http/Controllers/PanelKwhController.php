<?php

namespace App\Http\Controllers;

use App\Models\PanelKwh;
use Illuminate\Http\Request;

class PanelKwhController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {
        $panelKwh = PanelKwh::all();
        return view('panel-kwh.index', compact('panelKwh'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'no_pelanggan_pln' => 'required|unique:panel_kwh',
            'lokasi_panel' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        PanelKwh::create($request->all());

        return redirect()->back()->with('success', 'Data Panel KWh berhasil ditambahkan!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $panel = PanelKwh::findOrFail($id);
        
        $request->validate([
            'no_pelanggan_pln' => 'required|unique:panel_kwh,no_pelanggan_pln,' . $id,
            'lokasi_panel' => 'required',
        ]);

        $panel->update($request->all());

        return redirect()->back()->with('success', 'Data Panel KWh berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $panel = PanelKwh::findOrFail($id);
        $panel->delete();

        return redirect()->back()->with('success', 'Data Panel KWh berhasil dihapus!');
    }
}