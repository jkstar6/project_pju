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
            // ⚠️ pastikan nama tabel benar: panel_kwh (sesuai route/controller panel kamu)
            'panel_kwh_id' => 'required|exists:panel_kwh,id',

            'jalan_id'     => 'nullable',
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang',
            'jenis_lampu'  => 'nullable|string',
            'watt'         => 'nullable|numeric',
            'status_aset'  => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'desa'         => 'nullable|string',

            // ✅ lokasi aset dari map (klik/adjust)
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        // ✅ OPTIONAL: validasi jarak maksimal dari panel (misal 500 meter)
        $maxDistance = 500; // meter (ubah sesuai kebutuhan)
        $distance = $this->distanceMeters(
            (float) $panel->latitude,
            (float) $panel->longitude,
            (float) $request->latitude,
            (float) $request->longitude
        );

        if ($distance > $maxDistance) {
            return redirect()
                ->route('aset-pju.index')
                ->withErrors(['latitude' => "Jarak aset terlalu jauh dari panel (maks {$maxDistance} m). Sekarang: " . round($distance) . " m"])
                ->withInput();
        }

        AsetPju::create([
            'panel_kwh_id' => $panel->id,
            'jalan_id'     => $request->jalan_id,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset ?? 'Usulan',
            'warna_map'    => 'Kuning',

            // ✅ lokasi aset hasil klik/adjust (bukan ikut panel)
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,

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

            // ✅ lokasi aset dari map (klik/adjust)
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        // ✅ OPTIONAL: validasi jarak maksimal
        $maxDistance = 500; // meter
        $distance = $this->distanceMeters(
            (float) $panel->latitude,
            (float) $panel->longitude,
            (float) $request->latitude,
            (float) $request->longitude
        );

        if ($distance > $maxDistance) {
            return redirect()
                ->route('aset-pju.index')
                ->withErrors(['latitude' => "Jarak aset terlalu jauh dari panel (maks {$maxDistance} m). Sekarang: " . round($distance) . " m"])
                ->withInput();
        }

        $aset->update([
            'panel_kwh_id' => $panel->id,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset ?? $aset->status_aset,

            // ✅ lokasi aset hasil klik/adjust
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,

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

    /**
     * Hitung jarak 2 koordinat (meter) - Haversine
     */
    private function distanceMeters(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000; // meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2)
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
            * sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
