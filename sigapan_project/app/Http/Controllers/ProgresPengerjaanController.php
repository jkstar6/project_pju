<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgresPengerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('progres-pengerjaan.read');

        // TODO: Replace with actual database query
        // $progresPengerjaan = ProgresPengerjaan::with(['asetPju', 'user'])->latest()->get();
        
        // Mockup data
        $progresPengerjaan = [
            [
                'id' => 1,
                'aset_pju_id' => 10,
                'kode_aset' => 'PJU-NEW-001',
                'lokasi_proyek' => 'Jl. Ring Road Selatan',
                'user_id' => 2,
                'nama_petugas' => 'Budi Santoso',
                'tahapan' => 'Galian',
                'tgl_update' => '2025-01-15 08:00:00',
                'keterangan' => 'Galian pondasi tiang selesai, kedalaman 1.5m',
                'latitude_log' => -7.812345,
                'longitude_log' => 110.398765,
                'persentase' => 20
            ],
            [
                'id' => 2,
                'aset_pju_id' => 10,
                'kode_aset' => 'PJU-NEW-001',
                'lokasi_proyek' => 'Jl. Ring Road Selatan',
                'user_id' => 2,
                'nama_petugas' => 'Budi Santoso',
                'tahapan' => 'Pengecoran',
                'tgl_update' => '2025-01-16 10:30:00',
                'keterangan' => 'Pengecoran pondasi selesai, menunggu kering',
                'latitude_log' => -7.812345,
                'longitude_log' => 110.398765,
                'persentase' => 40
            ],
            [
                'id' => 3,
                'aset_pju_id' => 10,
                'kode_aset' => 'PJU-NEW-001',
                'lokasi_proyek' => 'Jl. Ring Road Selatan',
                'user_id' => 2,
                'nama_petugas' => 'Budi Santoso',
                'tahapan' => 'Pemasangan Tiang dan Armatur',
                'tgl_update' => '2025-01-18 09:00:00',
                'keterangan' => 'Tiang dan armatur terpasang dengan baik',
                'latitude_log' => -7.812345,
                'longitude_log' => 110.398765,
                'persentase' => 60
            ],
            [
                'id' => 4,
                'aset_pju_id' => 11,
                'kode_aset' => 'PJU-NEW-002',
                'lokasi_proyek' => 'Jl. Gedongkuning',
                'user_id' => 3,
                'nama_petugas' => 'Siti Aminah',
                'tahapan' => 'Pemasangan Jaringan',
                'tgl_update' => '2025-01-19 14:00:00',
                'keterangan' => 'Pemasangan kabel jaringan selesai, siap testing',
                'latitude_log' => -7.834567,
                'longitude_log' => 110.412345,
                'persentase' => 80
            ],
            [
                'id' => 5,
                'aset_pju_id' => 12,
                'kode_aset' => 'PJU-NEW-003',
                'lokasi_proyek' => 'Jl. Pathuk Barat',
                'user_id' => 2,
                'nama_petugas' => 'Budi Santoso',
                'tahapan' => 'Selesai',
                'tgl_update' => '2025-01-17 16:00:00',
                'keterangan' => 'Proyek selesai 100%, lampu sudah menyala',
                'latitude_log' => -7.845678,
                'longitude_log' => 110.423456,
                'persentase' => 100
            ],
        ];

        return view('progres-pengerjaan.index', compact('progresPengerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setRule('progres-pengerjaan.create');

        // TODO: Implement database insertion
        // ProgresPengerjaan::create($request->validated());

        return redirect()->back()->with('success', 'Progres pengerjaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource (by aset_pju_id).
     */
    public function show($asetPjuId)
    {
        $this->setRule('progres-pengerjaan.read');

        // TODO: Replace with actual database query
        // $progresHistory = ProgresPengerjaan::where('aset_pju_id', $asetPjuId)
        //     ->with('user')
        //     ->orderBy('tgl_update', 'asc')
        //     ->get();
        
        // Mockup data
        $progresHistory = [
            [
                'id' => 1,
                'tahapan' => 'Galian',
                'tgl_update' => '2025-01-15 08:00:00',
                'keterangan' => 'Galian pondasi tiang selesai, kedalaman 1.5m',
                'nama_petugas' => 'Budi Santoso',
                'persentase' => 20
            ],
            [
                'id' => 2,
                'tahapan' => 'Pengecoran',
                'tgl_update' => '2025-01-16 10:30:00',
                'keterangan' => 'Pengecoran pondasi selesai, menunggu kering',
                'nama_petugas' => 'Budi Santoso',
                'persentase' => 40
            ],
            [
                'id' => 3,
                'tahapan' => 'Pemasangan Tiang dan Armatur',
                'tgl_update' => '2025-01-18 09:00:00',
                'keterangan' => 'Tiang dan armatur terpasang dengan baik',
                'nama_petugas' => 'Budi Santoso',
                'persentase' => 60
            ],
        ];

        $asetInfo = [
            'id' => $asetPjuId,
            'kode_aset' => 'PJU-NEW-001',
            'lokasi' => 'Jl. Ring Road Selatan',
            'latitude' => -7.812345,
            'longitude' => 110.398765,
        ];

        return view('progres-pengerjaan.show', compact('progresHistory', 'asetInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->setRule('progres-pengerjaan.update');

        // TODO: Implement database update
        // $progres = ProgresPengerjaan::findOrFail($id);
        // $progres->update($request->validated());

        return redirect()->back()->with('success', 'Progres pengerjaan berhasil diperbarui');
    }
}