<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TindakanTeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('tindakan-teknisi.read');

        // TODO: Replace with actual database query
        // $logTindakan = LogTindakanTeknisi::with(['tiketPerbaikan', 'tiketPerbaikan.asetPju'])->latest()->get();
        
        // Mockup data
        $logTindakan = [
            [
                'id' => 1,
                'tiket_perbaikan_id' => 1,
                'no_tiket' => 'TKT-2025-001',
                'kode_aset' => 'PJU-002',
                'lokasi_aset' => 'Jl. Parangtritis Km 5',
                'hasil_cek' => 'MCB trip, kabel phase putus pada sambungan dekat tiang',
                'suku_cadang' => json_encode([
                    'kabel' => '5m',
                    'MCB' => '1 unit',
                    'isolasi' => '1 roll'
                ]),
                'foto_bukti_selesai' => 'bukti_perbaikan_1.jpg',
                'nama_teknisi' => 'Budi Santoso',
                'created_at' => '2025-01-20 14:30:00'
            ],
            [
                'id' => 2,
                'tiket_perbaikan_id' => 3,
                'no_tiket' => 'TKT-2025-003',
                'kode_aset' => 'PJU-005',
                'lokasi_aset' => 'Jl. Bantul Km 3',
                'hasil_cek' => 'Lampu LED rusak, sudah diganti dengan yang baru',
                'suku_cadang' => json_encode([
                    'lampu_led' => '1 unit',
                    'fitting' => '1 unit'
                ]),
                'foto_bukti_selesai' => 'bukti_perbaikan_2.jpg',
                'nama_teknisi' => 'Ahmad Fauzi',
                'created_at' => '2025-01-19 16:45:00'
            ],
            [
                'id' => 3,
                'tiket_perbaikan_id' => 5,
                'no_tiket' => 'TKT-2025-005',
                'kode_aset' => 'PJU-008',
                'lokasi_aset' => 'Jl. Wonosari Km 12',
                'hasil_cek' => 'Tiang roboh karena kecelakaan, perlu penggantian total',
                'suku_cadang' => json_encode([
                    'tiang_beton' => '1 unit',
                    'armatur' => '1 set',
                    'lampu_led' => '1 unit',
                    'kabel' => '15m'
                ]),
                'foto_bukti_selesai' => 'bukti_perbaikan_3.jpg',
                'nama_teknisi' => 'Hendra Wijaya',
                'created_at' => '2025-01-18 11:20:00'
            ],
        ];

        return view('tindakan-teknisi.index', compact('logTindakan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setRule('tindakan-teknisi.create');

        // TODO: Implement database insertion with file upload
        // $request->validate([
        //     'tiket_perbaikan_id' => 'required|exists:tiket_perbaikan,id',
        //     'hasil_cek' => 'required|string',
        //     'suku_cadang' => 'required|array',
        //     'foto_bukti_selesai' => 'nullable|image|max:2048'
        // ]);

        // Handle file upload
        // if ($request->hasFile('foto_bukti_selesai')) {
        //     $fotoPath = $request->file('foto_bukti_selesai')->store('tindakan-teknisi', 'public');
        // }

        // LogTindakanTeknisi::create([
        //     'tiket_perbaikan_id' => $request->tiket_perbaikan_id,
        //     'hasil_cek' => $request->hasil_cek,
        //     'suku_cadang' => json_encode($request->suku_cadang),
        //     'foto_bukti_selesai' => $fotoPath ?? null
        // ]);

        return redirect()->back()->with('success', 'Log tindakan teknisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->setRule('tindakan-teknisi.read');

        // TODO: Replace with actual database query
        // $logTindakan = LogTindakanTeknisi::with(['tiketPerbaikan.asetPju'])->findOrFail($id);

        // Mockup data
        $logTindakan = [
            'id' => $id,
            'tiket_perbaikan_id' => 1,
            'no_tiket' => 'TKT-2025-001',
            'kode_aset' => 'PJU-002',
            'lokasi_aset' => 'Jl. Parangtritis Km 5',
            'hasil_cek' => 'MCB trip, kabel phase putus pada sambungan dekat tiang. Penyebab: kabel terkelupas akibat gesekan dengan tiang besi.',
            'suku_cadang' => [
                'kabel' => '5m',
                'MCB' => '1 unit',
                'isolasi' => '1 roll'
            ],
            'foto_bukti_selesai' => 'bukti_perbaikan_1.jpg',
            'nama_teknisi' => 'Budi Santoso',
            'nama_tim' => 'Tim Teknisi 1',
            'created_at' => '2025-01-20 14:30:00'
        ];

        return view('tindakan-teknisi.show', compact('logTindakan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('tindakan-teknisi.update');

        // TODO: Replace with actual database query
        // return LogTindakanTeknisi::findOrFail($id);

        // Mockup data
        $log = [
            'id' => $id,
            'tiket_perbaikan_id' => 1,
            'hasil_cek' => 'MCB trip, kabel phase putus',
            'suku_cadang' => [
                'kabel' => '5m',
                'MCB' => '1 unit',
                'isolasi' => '1 roll'
            ],
        ];

        return response()->json($log);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->setRule('tindakan-teknisi.update');

        // TODO: Implement database update
        // $log = LogTindakanTeknisi::findOrFail($id);
        // $log->update($request->validated());

        return redirect()->back()->with('success', 'Log tindakan teknisi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('tindakan-teknisi.delete');

        // TODO: Implement database deletion
        // LogTindakanTeknisi::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Log tindakan teknisi berhasil dihapus');
    }
}