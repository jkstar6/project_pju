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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Landing Routes
|--------------------------------------------------------------------------
*/
// Route::resource('/beranda', BerandaController::class)->names(['beranda']);
// Route::redirect('/', '/beranda');
Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Landing Routes
|--------------------------------------------------------------------------
*/
Route::get('/map', function () {
    return view('map');
});

// ✅ (Opsional tapi rapi) naming untuk halaman aduan
Route::get('/aduan', function () {
    return view('aduan');
})->name('aduan.create');

// ✅ WAJIB: ini yang bikin route('aduan.store') tidak error
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');

Route::get('/daftar-aduan', function () {
    return view('daftar-aduan');
});
Route::get('/detail-aduan/{id}', function ($id) {
    // Memanggil file resources/views/detail-aduan.blade.php
    return view('detail-aduan');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth', 'verified')->group(function () {
    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/halaman-aduan', function () {
    // Memanggil file: resources/views/aduan-admin/index.blade.php
    return view('aduan-admin.index');
});
    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Add this to routes/web.php inside the Route::middleware(['auth', 'verified'])->group(function () {...});

// ===================================================================
// PJU MANAGEMENT ROUTES
// ===================================================================
// PJU MANAGEMENT ROUTES

// Tim Lapangan Management
Route::prefix('/tim-lapangan')->name('tim-lapangan.')->group(function () {
    Route::get('/', [App\Http\Controllers\TimLapanganController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\TimLapanganController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\TimLapanganController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\TimLapanganController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\TimLapanganController::class, 'destroy'])->name('destroy');
});

// Log Survey Management
Route::prefix('/log-survey')->name('log-survey.')->group(function () {
    Route::get('/', [App\Http\Controllers\LogSurveyController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\LogSurveyController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\LogSurveyController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\LogSurveyController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\LogSurveyController::class, 'destroy'])->name('destroy');
});

// Tiket Perbaikan Management
Route::prefix('/tiket-perbaikan')->name('tiket-perbaikan.')->group(function () {
    Route::get('/', [App\Http\Controllers\TiketPerbaikanController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\TiketPerbaikanController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\TiketPerbaikanController::class, 'show'])->name('show');
    Route::put('/{id}', [App\Http\Controllers\TiketPerbaikanController::class, 'update'])->name('update');
    Route::put('/{id}/status', [App\Http\Controllers\TiketPerbaikanController::class, 'updateStatus'])->name('updateStatus');
});

// Progres Pengerjaan Management
Route::prefix('/progres-pengerjaan')->name('progres-pengerjaan.')->group(function () {
    Route::get('/', [App\Http\Controllers\ProgresPengerjaanController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\ProgresPengerjaanController::class, 'store'])->name('store');
    Route::get('/{asetPjuId}', [App\Http\Controllers\ProgresPengerjaanController::class, 'show'])->name('show');
    Route::put('/{id}', [App\Http\Controllers\ProgresPengerjaanController::class, 'update'])->name('update');
});

// // Tim Lapangan Management
// Route::prefix('admin/tim-lapangan')->name('admin.tim-lapangan.')->group(function () {
//     Route::get('/', [App\Http\Controllers\Admin\TimLapanganController::class, 'index'])->name('index');
//     Route::post('/', [App\Http\Controllers\Admin\TimLapanganController::class, 'store'])->name('store');
//     Route::get('/{id}/edit', [App\Http\Controllers\Admin\TimLapanganController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [App\Http\Controllers\Admin\TimLapanganController::class, 'update'])->name('update');
//     Route::delete('/{id}', [App\Http\Controllers\Admin\TimLapanganController::class, 'destroy'])->name('destroy');
// });

// // Log Survey Management
// Route::prefix('admin/log-survey')->name('admin.log-survey.')->group(function () {
//     Route::get('/', [App\Http\Controllers\Admin\LogSurveyController::class, 'index'])->name('index');
//     Route::post('/', [App\Http\Controllers\Admin\LogSurveyController::class, 'store'])->name('store');
//     Route::get('/{id}/edit', [App\Http\Controllers\Admin\LogSurveyController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [App\Http\Controllers\Admin\LogSurveyController::class, 'update'])->name('update');
//     Route::delete('/{id}', [App\Http\Controllers\Admin\LogSurveyController::class, 'destroy'])->name('destroy');
// });

// // Tiket Perbaikan Management
// Route::prefix('admin/tiket-perbaikan')->name('admin.tiket-perbaikan.')->group(function () {
//     Route::get('/', [App\Http\Controllers\Admin\TiketPerbaikanController::class, 'index'])->name('index');
//     Route::post('/', [App\Http\Controllers\Admin\TiketPerbaikanController::class, 'store'])->name('store');
//     Route::get('/{id}', [App\Http\Controllers\Admin\TiketPerbaikanController::class, 'show'])->name('show');
//     Route::put('/{id}', [App\Http\Controllers\Admin\TiketPerbaikanController::class, 'update'])->name('update');
//     Route::put('/{id}/status', [App\Http\Controllers\Admin\TiketPerbaikanController::class, 'updateStatus'])->name('updateStatus');
// });

// // Progres Pengerjaan Management
// Route::prefix('admin/progres-pengerjaan')->name('admin.progres-pengerjaan.')->group(function () {
//     Route::get('/', [App\Http\Controllers\Admin\ProgresPengerjaanController::class, 'index'])->name('index');
//     Route::post('/', [App\Http\Controllers\Admin\ProgresPengerjaanController::class, 'store'])->name('store');
//     Route::get('/{asetPjuId}', [App\Http\Controllers\Admin\ProgresPengerjaanController::class, 'show'])->name('show');
//     Route::put('/{id}', [App\Http\Controllers\Admin\ProgresPengerjaanController::class, 'update'])->name('update');
// });
    /* ---- Settings */
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        /* Users */
        Route::resource('users', UsersController::class)->names('users');
        /* Roles */
        Route::resource('roles', RolesController::class)->names('roles');
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
        /* Navigation */
        Route::resource('navs', NavigationsController::class)->names('navs');
        /* Preferences */
        Route::resource('preferences', PreferencesController::class)->names('preferences');
    });
});

require __DIR__ . '/auth.php';

// Change Locale Language
Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])->name('change-locale');

// Route::middleware('auth')->group(function () {
//     Route::resource('home', HomeController::class);
//     Route::prefix('settings')->name('settings.')->group(function () {
//         Route::resource('users', HomeController::class);
//     });
// });
