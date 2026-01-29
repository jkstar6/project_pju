<?php

namespace App\Http\Controllers;

use App\Models\AsetPju;
use App\Models\PanelKwh;
use App\Models\KoneksiPjuKwh;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display the public map with PJU distribution
     */
    public function index()
    {
        // Get all Panel KWH with their coordinates
        $panelKwh = PanelKwh::select(
            'id',
            'no_pelanggan_pln',
            'lokasi_panel',
            'latitude',
            'longitude',
            'daya_va'
        )->get();

        // Get all Street Lights (Aset PJU) with their coordinates
        $streetLights = AsetPju::select(
            'id',
            'panel_kwh_id',
            'kode_tiang',
            'jenis_lampu',
            'watt',
            'status_aset',
            'warna_map',
            'latitude',
            'longitude',
            'kecamatan',
            'desa'
        )->get();

        // Get all connections between PJU and Panel KWH
        $koneksiPjuKwh = KoneksiPjuKwh::select(
            'id',
            'aset_pju_id',
            'panel_kwh_id',
            'nomor_mcb_panel',
            'fasa',
            'status_koneksi',
            'tgl_koneksi',
            'panjang_kabel_est',
            'keterangan_jalur'
        )
        ->where('status_koneksi', 'Aktif') // Only show active connections
        ->get();

        return view('map', compact('panelKwh', 'streetLights', 'koneksiPjuKwh'));
    }
}