<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/* =======================
|  CONTROLLERS
======================= */
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AsetPjuController;
use App\Http\Controllers\MasterJalanController;
use App\Http\Controllers\PanelKwhController;
use App\Http\Controllers\KoneksiJaringanController;
use App\Http\Controllers\LogSurveyController;
use App\Http\Controllers\TimLapanganController;
use App\Http\Controllers\TiketPerbaikanController;
use App\Http\Controllers\TindakanTeknisiController;
use App\Http\Controllers\ProgresPengerjaanController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Settings\UsersController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\Settings\NavigationsController;
use App\Http\Controllers\Admin\Settings\PreferencesController;


/* =======================
|  PUBLIC / LANDING
======================= */
Route::get('/', fn () => view('home'));

Route::get('/map', [MapController::class, 'index'])->name('map.index');

Route::get('/aduan', fn () => view('aduan'))->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
Route::get('/daftar-aduan', [AduanController::class, 'daftarAduan'])->name('daftar-aduan');
Route::get('/detail-aduan/{id}', [AduanController::class, 'detail'])->name('aduan.detail');

/* =======================
|  ADMIN (AUTH REQUIRED)
======================= */
Route::middleware(['auth', 'verified'])->group(function () {

    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /* ---- Aduan */
    Route::get('/halaman-aduan', [AduanController::class, 'index'])
        ->name('halaman-aduan.index');
    Route::post('/aduan/{id}/verifikasi', [AduanController::class, 'verifikasi'])
        ->name('aduan.verifikasi');
    Route::post('/aduan/{id}/tolak', [AduanController::class, 'tolak'])
        ->name('aduan.tolak');
    Route::delete('/aduan/{id}', [AduanController::class, 'destroy'])
        ->name('aduan.hapus');

    /* ---- Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---- Aset PJU */
    Route::prefix('aset-pju')->name('aset-pju.')->group(function () {
        Route::get('/', [AsetPjuController::class, 'index'])->name('index');
        Route::post('/', [AsetPjuController::class, 'store'])->name('store');
        Route::put('/{id}', [AsetPjuController::class, 'update'])->name('update');
    });

    /* ---- Master Jalan */
    Route::prefix('master-jalan')->name('master-jalan.')->group(function () {
        Route::get('/', [MasterJalanController::class, 'index'])->name('index');
        Route::post('/', [MasterJalanController::class, 'store'])->name('store');
        Route::put('/{id}', [MasterJalanController::class, 'update'])->name('update');
    });

    /* ---- Panel KWh */
    Route::prefix('panel-kwh')->name('panel-kwh.')->group(function () {
        Route::get('/', [PanelKwhController::class, 'index'])->name('index');
        Route::post('/', [PanelKwhController::class, 'store'])->name('store');
        Route::put('/{id}', [PanelKwhController::class, 'update'])->name('update');
        Route::delete('/{id}', [PanelKwhController::class, 'destroy'])->name('destroy');
    });

    /* ---- ✅ Koneksi Jaringan (PJU → Panel KWh) */
    Route::middleware(['auth'])->group(function () {
    Route::prefix('koneksi-jaringan')->name('koneksi-jaringan.')->group(function () {
        Route::get('/', [KoneksiJaringanController::class, 'index'])->name('index');
        Route::post('/', [KoneksiJaringanController::class, 'store'])->name('store');
        Route::put('/{id}', [KoneksiJaringanController::class, 'update'])->name('update');
        Route::delete('/{id}', [KoneksiJaringanController::class, 'destroy'])->name('destroy');
    });
});

    /* ---- Tim Lapangan */
    Route::prefix('tim-lapangan')->name('tim-lapangan.')->group(function () {
        Route::get('/', [TimLapanganController::class, 'index'])->name('index');
        Route::post('/', [TimLapanganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TimLapanganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TimLapanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [TimLapanganController::class, 'destroy'])->name('destroy');
    });

    /* ---- Tindakan Teknisi */
    Route::prefix('tindakan-teknisi')->name('tindakan-teknisi.')->group(function () {
        Route::get('/', [TindakanTeknisiController::class, 'index'])->name('index');
        Route::get('/{id}', [TindakanTeknisiController::class, 'show'])->name('show');
        Route::post('/', [TindakanTeknisiController::class, 'store'])->name('store');
        Route::put('/{id}', [TindakanTeknisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TindakanTeknisiController::class, 'destroy'])->name('destroy');
    });

    /* ---- Log Survey */
    Route::prefix('log-survey')->name('log-survey.')->group(function () {
        Route::get('/', [LogSurveyController::class, 'index'])->name('index');
        Route::post('/', [LogSurveyController::class, 'store'])->name('store');
        Route::put('/{id}', [LogSurveyController::class, 'update'])->name('update');
        Route::delete('/{id}', [LogSurveyController::class, 'destroy'])->name('destroy');
    });

    /* ---- Tiket Perbaikan */
    Route::prefix('tiket-perbaikan')->name('tiket-perbaikan.')->group(function () {
        Route::get('/', [TiketPerbaikanController::class, 'index'])->name('index');
        Route::get('/get-verified-aduan', [TiketPerbaikanController::class, 'getVerifiedAduan'])
            ->name('get-verified-aduan');
        Route::post('/', [TiketPerbaikanController::class, 'store'])->name('store');
        Route::get('/{id}', [TiketPerbaikanController::class, 'show'])->name('show');
        Route::put('/{id}', [TiketPerbaikanController::class, 'update'])->name('update');
        Route::delete('/{id}', [TiketPerbaikanController::class, 'destroy'])->name('destroy');
    });

    /* ---- Progres Pengerjaan */
    Route::prefix('progres-pengerjaan')->name('progres-pengerjaan.')->group(function () {
        Route::get('/', [ProgresPengerjaanController::class, 'index'])->name('index');
        Route::get('/{asetPjuId}', [ProgresPengerjaanController::class, 'show'])->name('show');
        Route::post('/', [ProgresPengerjaanController::class, 'store'])->name('store');
        Route::put('/{id}', [ProgresPengerjaanController::class, 'update'])->name('update');
    });

    /* ---- Settings */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])
            ->name('roles.permissions');
        Route::resource('navs', NavigationsController::class);
        Route::resource('preferences', PreferencesController::class);
    });
});

/* =======================
|  AUTH & LOCALE
======================= */
require __DIR__.'/auth.php';

Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])
    ->name('change-locale');
