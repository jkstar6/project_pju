<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiketPerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->setRule('tiket-perbaikan.read');

        // TODO: Replace with actual database query
        // $tiketPerbaikan = TiketPerbaikan::with(['pengaduan', 'asetPju', 'timLapangan'])->latest()->get();
        
        // Mockup data
        $tiketPerbaikan = [
            [
                'id' => 1,
                'pengaduan_id' => 1,
                'no_tiket' => 'TKT-2025-001',
                'aset_pju_id' => 2,
                'kode_aset' => 'PJU-002',
                'lokasi_aset' => 'Jl. Parangtritis Km 5',
                'tim_lapangan_id' => 1,
                'nama_tim' => 'Tim Teknisi 1',
                'tgl_jadwal' => '2025-01-20',
                'prioritas' => 'Mendesak',
                'status_tindakan' => 'Proses',
                'perlu_surat_pln' => false,
                'nama_pelapor' => 'Budi Hartono',
                'created_at' => '2025-01-19 10:30:00'
            ],
            [
                'id' => 2,
                'pengaduan_id' => 2,
                'no_tiket' => 'TKT-2025-002',
                'aset_pju_id' => 3,
                'kode_aset' => 'PJU-003',
                'lokasi_aset' => 'Jl. Imogiri Timur Km 10',
                'tim_lapangan_id' => 2,
                'nama_tim' => 'Tim Teknisi 2',
                'tgl_jadwal' => '2025-01-21',
                'prioritas' => 'Mendesak',
                'status_tindakan' => 'Menunggu',
                'perlu_surat_pln' => true,
                'nama_pelapor' => 'Siti Rahayu',
                'created_at' => '2025-01-19 11:00:00'
            ],
            [
                'id' => 3,
                'pengaduan_id' => 3,
                'no_tiket' => 'TKT-2025-003',
                'aset_pju_id' => 5,
                'kode_aset' => 'PJU-005',
                'lokasi_aset' => 'Jl. Bantul Km 3',
                'tim_lapangan_id' => 1,
                'nama_tim' => 'Tim Teknisi 1',
                'tgl_jadwal' => '2025-01-22',
                'prioritas' => 'Biasa',
                'status_tindakan' => 'Selesai',
                'perlu_surat_pln' => false,
                'nama_pelapor' => 'Ahmad Yani',
                'created_at' => '2025-01-18 14:15:00'
            ],
        ];

        return view('tiket-perbaikan.index', compact('tiketPerbaikan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->setRule('tiket-perbaikan.create');

        // TODO: Implement database insertion
        // TiketPerbaikan::create($request->validated());

        return redirect()->back()->with('success', 'Tiket perbaikan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $this->setRule('tiket-perbaikan.read');

        // TODO: Replace with actual database query
        // $tiket = TiketPerbaikan::with(['pengaduan', 'asetPju', 'timLapangan', 'logTindakan'])->findOrFail($id);
        
        // Mockup data
        $tiket = [
            'id' => $id,
            'no_tiket' => 'TKT-2025-001',
            'pengaduan_id' => 1,
            'aset_pju_id' => 2,
            'kode_aset' => 'PJU-002',
            'lokasi_aset' => 'Jl. Parangtritis Km 5',
            'tim_lapangan_id' => 1,
            'nama_tim' => 'Tim Teknisi 1',
            'ketua_tim' => 'Budi Santoso',
            'tgl_jadwal' => '2025-01-20',
            'prioritas' => 'Mendesak',
            'status_tindakan' => 'Proses',
            'perlu_surat_pln' => false,
            'pengaduan' => [
                'nama_pelapor' => 'Budi Hartono',
                'no_hp' => '081234567890',
                'tipe_aduan' => 'lampu_mati',
                'judul' => 'Lampu PJU Mati Total',
                'deskripsi' => 'Lampu PJU di depan rumah saya mati total sejak 3 hari yang lalu',
                'latitude' => -7.823456,
                'longitude' => 110.378901,
            ],
            'log_tindakan' => [
                'hasil_cek' => 'MCB trip, kabel phase putus',
                'suku_cadang' => json_encode(['kabel' => '5m', 'MCB' => '1 unit']),
                'created_at' => '2025-01-20 10:00:00',
            ],
            'created_at' => '2025-01-19 10:30:00'
        ];

        return view('tiket-perbaikan.show', compact('tiket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $this->setRule('tiket-perbaikan.update');

        // TODO: Implement database update
        // $tiket = TiketPerbaikan::findOrFail($id);
        // $tiket->update($request->validated());

        return redirect()->back()->with('success', 'Tiket perbaikan berhasil diperbarui');
    }

    /**
     * Update status tiket perbaikan
     */
    public function updateStatus(Request $request, $id)
    {
        // $this->setRule('tiket-perbaikan.update');

        // TODO: Implement status update
        // $tiket = TiketPerbaikan::findOrFail($id);
        // $tiket->update(['status_tindakan' => $request->status]);

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui');
    }
}