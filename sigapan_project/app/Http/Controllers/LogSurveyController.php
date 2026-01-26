<?php

namespace App\Http\Controllers;

use App\Models\LogSurvey;
use App\Models\AsetPju;
use App\Models\User;
use Illuminate\Http\Request;

class LogSurveyController extends Controller
{
    public function index()
    {
        // Mengambil log dengan relasi aset dan user agar nama muncul di tabel
        $logSurvey = LogSurvey::with(['aset', 'user'])->latest()->get();
        
        // Data untuk dropdown di Modal
        $asets = AsetPju::all(); 
        $users = User::all(); 

        return view('log-survey.index', compact('logSurvey', 'asets', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_pju_id' => 'required|exists:aset_pju,id',
            'user_id' => 'required|exists:users,id',
            'tgl_survey' => 'required|date',
            'kondisi' => 'required|in:Nyala,Mati,Rusak Fisik',
            'keberadaan' => 'required|in:Ada,Hilang',
            'lat_input' => 'required|numeric',
            'long_input' => 'required|numeric',
        ]);

        LogSurvey::create($request->all());

        return redirect()->back()->with('success', 'Data log survey berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $log = LogSurvey::findOrFail($id);

        $request->validate([
            'aset_pju_id' => 'required|exists:aset_pju,id',
            'user_id' => 'required|exists:users,id',
            'tgl_survey' => 'required|date',
            'kondisi' => 'required|in:Nyala,Mati,Rusak Fisik',
            'keberadaan' => 'required|in:Ada,Hilang',
            // Tambahkan lat/long di update agar tidak gagal validasi jika form mengirimkannya
            'lat_input' => 'nullable|numeric',
            'long_input' => 'nullable|numeric',
        ]);

        $log->update($request->all());

        return redirect()->back()->with('success', 'Data log survey berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $log = LogSurvey::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'Data log survey berhasil dihapus.');
    }
}