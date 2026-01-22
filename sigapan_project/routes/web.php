<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Operator\HomeController;
use App\Http\Controllers\Landing\BerandaController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\Settings\UsersController;
use App\Http\Controllers\Admin\Settings\NavigationsController;
use App\Http\Controllers\Admin\Settings\PreferencesController;

// ✅ Tambahan untuk Aduan
use App\Http\Controllers\AduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Landing Routes
|--------------------------------------------------------------------------
*/
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

// =========================================================================
// ✅ PERBAIKAN DI SINI:
// Menggunakan Controller agar data yang Diterima bisa muncul
// =========================================================================
Route::get('/daftar-aduan', [AduanController::class, 'daftarAduan'])->name('daftar-aduan');

// Detail Aduan (Opsional: Bisa diarahkan ke controller jika ingin detailnya dinamis juga)
Route::get('/detail-aduan/{id}', [AduanController::class, 'detail'])->name('aduan.detail');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth', 'verified')->group(function () {

    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* ---- Halaman Aduan (Admin List) */
    Route::get('/halaman-aduan', [AduanController::class, 'index'])
        ->name('halaman-aduan.index');

    // =========================================================
    // ✅ LOGIC VERIFIKASI ADUAN
    // =========================================================
    Route::post('/aduan/{id}/verifikasi', [AduanController::class, 'verifikasi'])
        ->name('aduan.verifikasi');

    Route::post('/aduan/{id}/tolak', [AduanController::class, 'tolak'])
        ->name('aduan.tolak');

    // HAPUS
    Route::delete('/aduan/{id}', [AduanController::class, 'destroy'])
        ->name('aduan.hapus');
    // =========================================================

    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===================================================================
    // PJU MANAGEMENT ROUTES
    // ===================================================================

    Route::prefix('/tim-lapangan')->name('tim-lapangan.')->group(function () {
        Route::get('/', [App\Http\Controllers\TimLapanganController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\TimLapanganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\TimLapanganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\TimLapanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\TimLapanganController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/tindakan-teknisi')->name('tindakan-teknisi.')->group(function () {
        Route::get('/', [App\Http\Controllers\TindakanTeknisiController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\TindakanTeknisiController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\TindakanTeknisiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\TindakanTeknisiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\TindakanTeknisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\TindakanTeknisiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/log-survey')->name('log-survey.')->group(function () {
        Route::get('/', [App\Http\Controllers\LogSurveyController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\LogSurveyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\LogSurveyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\LogSurveyController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\LogSurveyController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/tiket-perbaikan')->name('tiket-perbaikan.')->group(function () {
        Route::get('/', [App\Http\Controllers\TiketPerbaikanController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\TiketPerbaikanController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\TiketPerbaikanController::class, 'show'])->name('show');
        Route::put('/{id}', [App\Http\Controllers\TiketPerbaikanController::class, 'update'])->name('update');
        Route::put('/{id}/status', [App\Http\Controllers\TiketPerbaikanController::class, 'updateStatus'])->name('updateStatus');
    });

    Route::prefix('/progres-pengerjaan')->name('progres-pengerjaan.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProgresPengerjaanController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\ProgresPengerjaanController::class, 'store'])->name('store');
        Route::get('/{asetPjuId}', [App\Http\Controllers\ProgresPengerjaanController::class, 'show'])->name('show');
        Route::put('/{id}', [App\Http\Controllers\ProgresPengerjaanController::class, 'update'])->name('update');
    });

    /* ---- Settings */
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::resource('users', UsersController::class)->names('users');
        Route::resource('roles', RolesController::class)->names('roles');
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
        Route::resource('navs', NavigationsController::class)->names('navs');
        Route::resource('preferences', PreferencesController::class)->names('preferences');
    });
});

require __DIR__ . '/auth.php';

Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])->name('change-locale');