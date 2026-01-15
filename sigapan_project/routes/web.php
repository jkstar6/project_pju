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
Route::get('/detail-aduan', function () {
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

    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
