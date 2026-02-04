<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\PanelKwh;
use App\Models\MasterJalan;
use App\Models\KoneksiPjuKwh;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsetPjuController extends Controller
{
    public function index()
    {
        $asetPju = AsetPju::with(['jalan', 'panelKwh'])
            ->orderBy('created_at', 'desc')
            ->get();

        // PERBAIKAN DI SINI: Ubah nama variabel jadi $panelKwhList
        $panelKwhList = PanelKwh::select('id','no_pelanggan_pln','daya_va','latitude','longitude','lokasi_panel')
            ->orderBy('created_at', 'desc')
            ->get();

        // PERBAIKAN DI SINI: Ubah nama variabel jadi $jalanList
        $jalanList = MasterJalan::orderBy('nama_jalan')->get();

        // Kirim variabel yang sudah diganti namanya ke view
        return view('aset-pju.index', compact('asetPju', 'panelKwhList', 'jalanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'panel_kwh_id' => ['required', Rule::exists((new PanelKwh)->getTable(), 'id')],
            'jalan_id'     => ['nullable', Rule::exists('master_jalan', 'id')],
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang',
            'jenis_lampu'  => 'nullable|string',
            'watt'         => 'nullable|numeric',
            'status_aset'  => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'desa'         => 'nullable|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        $maxDistance = 500;
        $distance = $this->distanceMeters(
            (float) $panel->latitude,
            (float) $panel->longitude,
            (float) $request->latitude,
            (float) $request->longitude
        );

        if ($distance > $maxDistance) {
            return redirect()
                ->route('aset-pju.index')
                ->withErrors([
                    'latitude' => "Jarak aset terlalu jauh dari panel (maks {$maxDistance} m). Sekarang: " . round($distance) . " m"
                ])
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
            'panel_kwh_id' => ['required', Rule::exists((new PanelKwh)->getTable(), 'id')],
            'jalan_id'     => ['nullable', Rule::exists('master_jalan', 'id')],
            'kode_tiang'   => 'required|unique:aset_pju,kode_tiang,' . $aset->id,
            'jenis_lampu'  => 'nullable|string',
            'watt'         => 'nullable|numeric',
            'status_aset'  => 'required|in:Usulan,Pengerjaan,Terelialisasi,Pindah,Mati',
            'kecamatan'    => 'nullable|string',
            'desa'         => 'nullable|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        $panel = PanelKwh::findOrFail($request->panel_kwh_id);

        // Validasi Jarak
        $maxDistance = 500;
        $distance = $this->distanceMeters(
            (float) $panel->latitude,
            (float) $panel->longitude,
            (float) $request->latitude,
            (float) $request->longitude
        );

        if ($distance > $maxDistance) {
            return redirect()
                ->route('aset-pju.index')
                ->withErrors([
                    'latitude' => "Jarak aset terlalu jauh dari panel (maks {$maxDistance} m). Sekarang: " . round($distance) . " m"
                ])
                ->withInput();
        }

        // [LOGIKA HAPUS OTOMATIS KONEKSI JIKA PINDAH]
        if (
            $aset->panel_kwh_id != $request->panel_kwh_id ||
            $aset->latitude != $request->latitude ||
            $aset->longitude != $request->longitude
        ) {
            KoneksiPjuKwh::where('aset_pju_id', $aset->id)->delete();
        }

        $aset->update([
            'panel_kwh_id' => $panel->id,
            'jalan_id'     => $request->jalan_id,
            'kode_tiang'   => $request->kode_tiang,
            'jenis_lampu'  => $request->jenis_lampu,
            'watt'         => $request->watt,
            'status_aset'  => $request->status_aset,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'kecamatan'    => $request->kecamatan,
            'desa'         => $request->desa,
        ]);

        return redirect()
            ->route('aset-pju.index')
            ->with('success', 'Aset PJU berhasil diperbarui (Koneksi jaringan disesuaikan jika lokasi/panel berubah)');
    }

    public function destroy($id)
    {
        AsetPju::findOrFail($id)->delete();
        return redirect()->route('aset-pju.index')->with('success', 'Aset PJU berhasil dihapus');
    }

    private function distanceMeters(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}