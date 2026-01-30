<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoneksiPjuKwh;
use App\Models\AsetPju;
use App\Models\PanelKwh;
use Illuminate\Validation\ValidationException;

class KoneksiJaringanController extends Controller
{
    /**
     * Tampilkan daftar koneksi jaringan PJU ↔ Panel KWh
     */
    public function index()
    {
        // Data utama tabel koneksi
        $koneksi = KoneksiPjuKwh::with([
                'asetPju',
                'panelKwh'
            ])
            ->orderByDesc('id')
            ->get();

        // Data untuk dropdown aset PJU (modal)
        // Kita ambil semua untuk dikirim ke view, nanti JS yang filter
        $asetPju = AsetPju::orderByDesc('id')->get();

        // Data untuk dropdown panel KWh (modal)
        $panelKwh = PanelKwh::orderByDesc('id')->get();

        return view('koneksi_jaringan.index', compact(
            'koneksi',
            'asetPju',
            'panelKwh'
        ));
    }

    /**
     * Simpan koneksi jaringan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aset_pju_id'    => 'required|exists:aset_pju,id',
            'panel_kwh_id'   => 'required|exists:panel_kwh,id',
            'nomor_mcb_panel'=> 'nullable|string|max:20',
            'fasa'           => 'nullable|in:R,S,T',
            'status_koneksi' => 'required|in:Aktif,Diputus',
            'tgl_koneksi'    => 'nullable|date',
            'panjang_kabel_est' => 'nullable|numeric|min:0',
            'keterangan_jalur'  => 'nullable|string',
        ]);

        // Validasi Relasi: Pastikan Aset PJU memang milik Panel KWh tersebut
        $aset = AsetPju::findOrFail($request->aset_pju_id);
        
        if ($aset->panel_kwh_id != $request->panel_kwh_id) {
            throw ValidationException::withMessages([
                'aset_pju_id' => 'Aset PJU yang dipilih tidak terdaftar pada Panel KWh ini (Mismatch).',
            ]);
        }

        // Cek duplicate koneksi (opsional, agar 1 aset tidak punya 2 koneksi aktif)
        // Jika perlu: 
        // $exists = KoneksiPjuKwh::where('aset_pju_id', $request->aset_pju_id)->exists();
        // if($exists) ...

        KoneksiPjuKwh::create($validated);

        return redirect()
            ->route('koneksi-jaringan.index')
            ->with('success', 'Koneksi jaringan berhasil ditambahkan.');
    }

    /**
     * Update koneksi jaringan
     */
    public function update(Request $request, $id)
    {
        $koneksi = KoneksiPjuKwh::findOrFail($id);

        $validated = $request->validate([
            'aset_pju_id'    => 'required|exists:aset_pju,id',
            'panel_kwh_id'   => 'required|exists:panel_kwh,id',
            'nomor_mcb_panel'=> 'nullable|string|max:20',
            'fasa'           => 'nullable|in:R,S,T',
            'status_koneksi' => 'required|in:Aktif,Diputus',
            'tgl_koneksi'    => 'nullable|date',
            'panjang_kabel_est' => 'nullable|numeric|min:0',
            'keterangan_jalur'  => 'nullable|string',
        ]);

        // Validasi Relasi
        $aset = AsetPju::findOrFail($request->aset_pju_id);
        if ($aset->panel_kwh_id != $request->panel_kwh_id) {
            throw ValidationException::withMessages([
                'aset_pju_id' => 'Aset PJU yang dipilih tidak terdaftar pada Panel KWh ini (Mismatch).',
            ]);
        }

        $koneksi->update($validated);

        return redirect()
            ->route('koneksi-jaringan.index')
            ->with('success', 'Koneksi jaringan berhasil diperbarui.');
    }

    /**
     * Hapus koneksi jaringan
     */
    public function destroy($id)
    {
        KoneksiPjuKwh::findOrFail($id)->delete();

        return redirect()
            ->route('koneksi-jaringan.index')
            ->with('success', 'Koneksi jaringan berhasil dihapus.');
    }
}