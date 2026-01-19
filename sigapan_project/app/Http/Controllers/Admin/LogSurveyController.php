<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('log-survey.read');

        // TODO: Replace with actual database query
        // $logSurvey = LogSurvey::with(['asetPju', 'user'])->latest()->get();
        
        // Mockup data
        $logSurvey = [
            [
                'id' => 1,
                'aset_pju_id' => 1,
                'kode_aset' => 'PJU-001',
                'lokasi_aset' => 'Jl. Malioboro No. 1',
                'user_id' => 4,
                'nama_surveyor' => 'Ahmad Fauzi',
                'tgl_survey' => '2025-01-19',
                'kondisi' => 'Nyala',
                'keberadaan' => 'Ada',
                'lat_input' => -7.797068,
                'long_input' => 110.370529,
                'catatan_kerusakan' => null,
                'created_at' => '2025-01-19 08:30:00'
            ],
            [
                'id' => 2,
                'aset_pju_id' => 2,
                'kode_aset' => 'PJU-002',
                'lokasi_aset' => 'Jl. Parangtritis Km 5',
                'user_id' => 5,
                'nama_surveyor' => 'Dewi Sartika',
                'tgl_survey' => '2025-01-19',
                'kondisi' => 'Mati',
                'keberadaan' => 'Ada',
                'lat_input' => -7.823456,
                'long_input' => 110.378901,
                'catatan_kerusakan' => 'Lampu tidak menyala, kemungkinan MCB trip',
                'created_at' => '2025-01-19 09:15:00'
            ],
            [
                'id' => 3,
                'aset_pju_id' => 3,
                'kode_aset' => 'PJU-003',
                'lokasi_aset' => 'Jl. Imogiri Timur Km 10',
                'user_id' => 6,
                'nama_surveyor' => 'Hendra Wijaya',
                'tgl_survey' => '2025-01-19',
                'kondisi' => 'Rusak Fisik',
                'keberadaan' => 'Ada',
                'lat_input' => -7.845678,
                'long_input' => 110.412345,
                'catatan_kerusakan' => 'Tiang roboh karena kecelakaan kendaraan',
                'created_at' => '2025-01-19 10:00:00'
            ],
            [
                'id' => 4,
                'aset_pju_id' => 4,
                'kode_aset' => 'PJU-004',
                'lokasi_aset' => 'Jl. Wonosari Km 8',
                'user_id' => 4,
                'nama_surveyor' => 'Ahmad Fauzi',
                'tgl_survey' => '2025-01-18',
                'kondisi' => 'Nyala',
                'keberadaan' => 'Ada',
                'lat_input' => -7.856789,
                'long_input' => 110.445678,
                'catatan_kerusakan' => null,
                'created_at' => '2025-01-18 14:20:00'
            ],
        ];

        return view('admin.log-survey.index', compact('logSurvey'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setRule('log-survey.create');

        // TODO: Implement database insertion
        // LogSurvey::create($request->validated());

        return redirect()->back()->with('success', 'Log survey berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('log-survey.update');

        // TODO: Replace with actual database query
        // return LogSurvey::findOrFail($id);

        // Mockup data
        $log = [
            'id' => $id,
            'aset_pju_id' => 1,
            'user_id' => 4,
            'tgl_survey' => '2025-01-19',
            'kondisi' => 'Nyala',
            'keberadaan' => 'Ada',
            'lat_input' => -7.797068,
            'long_input' => 110.370529,
            'catatan_kerusakan' => null
        ];

        return response()->json($log);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->setRule('log-survey.update');

        // TODO: Implement database update
        // $log = LogSurvey::findOrFail($id);
        // $log->update($request->validated());

        return redirect()->back()->with('success', 'Log survey berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('log-survey.delete');

        // TODO: Implement database deletion
        // LogSurvey::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Log survey berhasil dihapus');
    }
}