<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimLapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('tim-lapangan.read');

        // TODO: Replace with actual database query
        // $timLapangan = TimLapangan::with(['leader', 'anggota'])->get();
        
        // Mockup data
        $timLapangan = [
            [
                'id' => 1,
                'nama_tim' => 'Tim Teknisi 1',
                'kategori' => 'Teknisi',
                'leader_id' => 2,
                'leader_name' => 'Budi Santoso',
                'jumlah_personel' => 5,
                'created_at' => '2024-01-15 08:00:00'
            ],
            [
                'id' => 2,
                'nama_tim' => 'Tim Teknisi 2',
                'kategori' => 'Teknisi',
                'leader_id' => 3,
                'leader_name' => 'Siti Aminah',
                'jumlah_personel' => 4,
                'created_at' => '2024-01-15 08:00:00'
            ],
            [
                'id' => 3,
                'nama_tim' => 'Tim Survey 1',
                'kategori' => 'Surveyor',
                'leader_id' => 4,
                'leader_name' => 'Ahmad Fauzi',
                'jumlah_personel' => 3,
                'created_at' => '2024-01-16 08:00:00'
            ],
            [
                'id' => 4,
                'nama_tim' => 'Tim Survey 2',
                'kategori' => 'Surveyor',
                'leader_id' => 5,
                'leader_name' => 'Dewi Sartika',
                'jumlah_personel' => 3,
                'created_at' => '2024-01-16 08:00:00'
            ],
            [
                'id' => 5,
                'nama_tim' => 'Tim Survey 3',
                'kategori' => 'Surveyor',
                'leader_id' => 6,
                'leader_name' => 'Hendra Wijaya',
                'jumlah_personel' => 3,
                'created_at' => '2024-01-16 08:00:00'
            ],
        ];

        return view('tim-lapangan.index', compact('timLapangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setRule('tim-lapangan.create');

        // TODO: Implement database insertion
        // TimLapangan::create($request->validated());

        return redirect()->back()->with('success', 'Tim lapangan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('tim-lapangan.update');

        // TODO: Replace with actual database query
        // return TimLapangan::findOrFail($id);

        // Mockup data
        $tim = [
            'id' => $id,
            'nama_tim' => 'Tim Teknisi 1',
            'kategori' => 'Teknisi',
            'leader_id' => 2,
            'jumlah_personel' => 5
        ];

        return response()->json($tim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->setRule('tim-lapangan.update');

        // TODO: Implement database update
        // $tim = TimLapangan::findOrFail($id);
        // $tim->update($request->validated());

        return redirect()->back()->with('success', 'Tim lapangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('tim-lapangan.delete');

        // TODO: Implement database deletion
        // TimLapangan::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Tim lapangan berhasil dihapus');
    }
}