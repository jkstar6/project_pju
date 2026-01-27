<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\AsetPjuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogSurveyController;
use App\Http\Controllers\TimLapanganController;
use App\Http\Controllers\TiketPerbaikanController;
use App\Http\Controllers\TindakanTeknisiController;
use App\Http\Controllers\ProgresPengerjaanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Operator\HomeController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\Settings\UsersController;
use App\Http\Controllers\Admin\Settings\NavigationsController;
use App\Http\Controllers\Admin\Settings\PreferencesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ---- Landing Routes */
Route::get('/', function () {
    return view('home');
});

Route::get('/map', function () {
    return view('map');
});

// Form Input Aduan
Route::get('/aduan', function () {
    return view('aduan');
})->name('aduan.create');

// Proses Simpan Aduan
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');
Route::get('/daftar-aduan', [AduanController::class, 'daftarAduan'])->name('daftar-aduan');
Route::get('/detail-aduan/{id}', [AduanController::class, 'detail'])->name('aduan.detail');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth', 'verified')->group(function () {

    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* ---- Aduan Management */
    Route::get('/halaman-aduan', [AduanController::class, 'index'])->name('halaman-aduan.index');
    Route::post('/aduan/{id}/verifikasi', [AduanController::class, 'verifikasi'])->name('aduan.verifikasi');
    Route::post('/aduan/{id}/tolak', [AduanController::class, 'tolak'])->name('aduan.tolak');
    Route::delete('/aduan/{id}', [AduanController::class, 'destroy'])->name('aduan.hapus');

    /* ---- Profile Management */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---- Aset PJU Management */
    Route::get('/aset-pju', [AsetPjuController::class, 'index'])->name('admin.aset-pju.index');
    Route::post('/aset-pju', [AsetPjuController::class, 'store'])->name('aset-pju.store');
    Route::delete('/aset-pju/{id}', [AsetPjuController::class, 'destroy'])
    ->name('aset-pju.destroy');

    /* ---- Tim Lapangan */
    Route::prefix('/tim-lapangan')->name('tim-lapangan.')->group(function () {
        Route::get('/', [TimLapanganController::class, 'index'])->name('index');
        Route::post('/', [TimLapanganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TimLapanganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TimLapanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [TimLapanganController::class, 'destroy'])->name('destroy');
    });

    /* ---- Tindakan Teknisi */
    Route::prefix('/tindakan-teknisi')->name('tindakan-teknisi.')->group(function () {
        Route::get('/', [TindakanTeknisiController::class, 'index'])->name('index');
        Route::post('/', [TindakanTeknisiController::class, 'store'])->name('store');
        Route::get('/{id}', [TindakanTeknisiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TindakanTeknisiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TindakanTeknisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TindakanTeknisiController::class, 'destroy'])->name('destroy');
    });

    /* ---- Log Survey (FIXED) */
    Route::prefix('/log-survey')->name('log-survey.')->group(function () {
        Route::get('/', [LogSurveyController::class, 'index'])->name('index');
        Route::post('/', [LogSurveyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LogSurveyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LogSurveyController::class, 'update'])->name('update');
        Route::delete('/{id}', [LogSurveyController::class, 'destroy'])->name('destroy');
    });

    /* ---- Tiket Perbaikan */
    Route::prefix('/tiket-perbaikan')->name('tiket-perbaikan.')->group(function () {
        Route::get('/get-verified-aduan', [TiketPerbaikanController::class, 'getVerifiedAduan'])->name('get-verified-aduan');
        Route::get('/', [TiketPerbaikanController::class, 'index'])->name('index');
        Route::post('/', [TiketPerbaikanController::class, 'store'])->name('store');
        Route::get('/{id}', [TiketPerbaikanController::class, 'show'])->name('show');
        Route::put('/{id}', [TiketPerbaikanController::class, 'update'])->name('update');
        Route::delete('/{id}', [TiketPerbaikanController::class, 'destroy'])->name('destroy');
    });

    /* ---- Progres Pengerjaan */
    Route::prefix('/progres-pengerjaan')->name('progres-pengerjaan.')->group(function () {
        Route::get('/', [ProgresPengerjaanController::class, 'index'])->name('index');
        Route::post('/', [ProgresPengerjaanController::class, 'store'])->name('store');
        Route::get('/{asetPjuId}', [ProgresPengerjaanController::class, 'show'])->name('show');
        Route::put('/{id}', [ProgresPengerjaanController::class, 'update'])->name('update');
    });

    /* ---- Settings Management */
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
        Route::resource('navs', NavigationsController::class);
        Route::resource('preferences', PreferencesController::class);
    });
});

require __DIR__ . '/auth.php';

Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])->name('change-locale');