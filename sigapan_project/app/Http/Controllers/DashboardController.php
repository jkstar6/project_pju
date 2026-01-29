<?php

namespace App\Http\Controllers;

use App\Models\User;

// ⬇️ import model yang dipakai
use App\Models\AsetPju;
use App\Models\PanelKwh;
use App\Models\LogSurvey;
use App\Models\MasterJalan;
use App\Models\TimLapangan;
use Illuminate\Http\Request;
use App\Models\KoneksiPjuKwh;
use App\Models\TiketPerbaikan;
use App\Models\TindakanTeknisi;
use App\Models\ProgresPengerjaan;
use App\Models\PengaduanMasyarakat;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        return view('dashboard.index', [
            'aduanCount'          => PengaduanMasyarakat::count(),
            'tiketPerbaikanCount' => TiketPerbaikan::count(),
            'logSurveyCount'      => LogSurvey::count(),
            'progresCount'        => ProgresPengerjaan::count(),
            'timLapanganCount'    => TimLapangan::count(),
            'userCount'           => User::count(),
            'tindakanCount'       => TindakanTeknisi::count(),
            'asetPjuCount'        => AsetPju::count(),
            'masterJalanCount'    => MasterJalan::count(),
            'panelKwhCount'       => PanelKwh::count(),
            'koneksiCount'        => KoneksiPjuKwh::count(),
        ]);
    }
}
