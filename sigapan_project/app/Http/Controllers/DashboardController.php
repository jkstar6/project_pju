<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AsetPju;
use App\Models\PanelKwh;
use App\Models\LogSurvey;
use App\Models\MasterJalan;
use App\Models\TimLapangan;
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
        // ✅ Data Card Dashboard (Looping)
        $dashboardCards = [

            [
                'title'  => 'Aduan Masuk',
                'count'  => PengaduanMasyarakat::count(),
                'desc'   => 'Semua aduan masuk',
                'href'   => url('/halaman-aduan'),
                'border' => 'border-blue-600',
                'bg'     => 'bg-blue-600',
                'icon'   => 'mail',
            ],

            [
                'title'  => 'Tiket Perbaikan',
                'count'  => TiketPerbaikan::count(),
                'desc'   => 'Daftar perbaikan berjalan',
                'href'   => url('/tiket-perbaikan'),
                'border' => 'border-green-500',
                'bg'     => 'bg-green-500',
                'icon'   => 'settings',
            ],

            [
                'title'  => 'Log Survey',
                'count'  => LogSurvey::count(),
                'desc'   => 'Daftar survey harian',
                'href'   => url('/log-survey'),
                'border' => 'border-yellow-500',
                'bg'     => 'bg-yellow-500',
                'icon'   => 'clipboard',
            ],

            [
                'title'  => 'Progres Pengerjaan',
                'count'  => ProgresPengerjaan::count(),
                'desc'   => 'Pengerjaan lampu',
                'href'   => url('/progres-pengerjaan'),
                'border' => 'border-red-500',
                'bg'     => 'bg-red-500',
                'icon'   => 'chart',
            ],

            [
                'title'  => 'Tim Lapangan',
                'count'  => TimLapangan::count(),
                'desc'   => 'Tim Survey dan Teknisi',
                'href'   => url('/tim-lapangan'),
                'border' => 'border-cyan-500',
                'bg'     => 'bg-cyan-500',
                'icon'   => 'users',
            ],

            [
                'title'  => 'User',
                'count'  => User::count(),
                'desc'   => 'Surveyor, Teknisi, dan Admin',
                'href'   => url('/settings/users'),
                'border' => 'border-orange-500',
                'bg'     => 'bg-orange-500',
                'icon'   => 'user',
            ],

            [
                'title'  => 'Tindakan Teknisi',
                'count'  => TindakanTeknisi::count(),
                'desc'   => 'Hasil Tindakan Teknisi',
                'href'   => url('/tindakan-teknisi'),
                'border' => 'border-pink-500',
                'bg'     => 'bg-pink-500',
                'icon'   => 'tool',
            ],

            [
                'title'  => 'Aset PJU',
                'count'  => AsetPju::count(),
                'desc'   => 'Jumlah aset PJU',
                'href'   => url('/aset-pju'),
                'border' => 'border-purple-500',
                'bg'     => 'bg-purple-500',
                'icon'   => 'bulb',
            ],

            [
                'title'  => 'Master Jalan',
                'count'  => MasterJalan::count(),
                'desc'   => 'Data ruas jalan',
                'href'   => url('/master-jalan'),
                'border' => 'border-indigo-500',
                'bg'     => 'bg-indigo-500',
                'icon'   => 'map',
            ],

            [
                'title'  => 'Panel Kwh',
                'count'  => PanelKwh::count(),
                'desc'   => 'Data panel KWh',
                'href'   => url('/panel-kwh'),
                'border' => 'border-emerald-500',
                'bg'     => 'bg-emerald-500',
                'icon'   => 'bolt',
            ],

            [
                'title'  => 'Koneksi Jaringan',
                'count'  => KoneksiPjuKwh::count(),
                'desc'   => 'Mapping jalur kabel PJU → Panel KWh',
                'href'   => url('/koneksi-jaringan'),
                'border' => 'border-fuchsia-500',
                'bg'     => 'bg-fuchsia-500',
                'icon'   => 'link',
            ],

        ];

        // ✅ Kirim array cards ke Blade dashboard
        return view('dashboard.index', compact('dashboardCards'));
    }
}
