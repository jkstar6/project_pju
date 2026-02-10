<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/detail-aduan/{id}', [AduanController::class, 'detail'])
    ->whereNumber('id')
    ->name('aduan.detail');

/* =======================
|  ADMIN AREA (AUTH REQUIRED)
======================= */
Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * SEMUA role yang login (Admin/Teknisi/Survey) minimal bisa akses area admin (READ)
     */
    Route::middleware(['role:Admin|Teknisi|Survey'])->group(function () {

        /* =======================
        |  DASHBOARD (READ)
        ======================= */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /* =======================
        |  ADUAN (READ untuk semua, ACTION hanya Admin)
        ======================= */
        Route::get('/halaman-aduan', [AduanController::class, 'index'])->name('halaman-aduan.index');

        Route::middleware(['role:Admin'])->group(function () {
            Route::post('/aduan/{id}/verifikasi', [AduanController::class, 'verifikasi'])
                ->whereNumber('id')
                ->name('aduan.verifikasi');

            Route::post('/aduan/{id}/tolak', [AduanController::class, 'tolak'])
                ->whereNumber('id')
                ->name('aduan.tolak');

            Route::delete('/aduan/{id}', [AduanController::class, 'destroy'])
                ->whereNumber('id')
                ->name('aduan.hapus');
        });

        /* =======================
        |  ASET PJU (READ semua, CRUD Admin)
        ======================= */
        Route::prefix('aset-pju')->name('aset-pju.')->group(function () {
            Route::get('/', [AsetPjuController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::post('/', [AsetPjuController::class, 'store'])->name('store');
                Route::put('/{id}', [AsetPjuController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
            });
        });

        /* =======================
        |  MASTER JALAN (READ semua, CRUD Admin)
        ======================= */
        Route::prefix('master-jalan')->name('master-jalan.')->group(function () {
            Route::get('/', [MasterJalanController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::post('/', [MasterJalanController::class, 'store'])->name('store');
                Route::put('/{id}', [MasterJalanController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
            });
        });

        /* =======================
        |  PANEL KWH (READ semua, CRUD Admin)
        ======================= */
        Route::prefix('panel-kwh')->name('panel-kwh.')->group(function () {
            Route::get('/', [PanelKwhController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::post('/', [PanelKwhController::class, 'store'])->name('store');
                Route::put('/{id}', [PanelKwhController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [PanelKwhController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });
        });

        /* =======================
        |  KONEKSI JARINGAN (READ semua, CRUD Admin)
        ======================= */
        Route::prefix('koneksi-jaringan')->name('koneksi-jaringan.')->group(function () {
            Route::get('/', [KoneksiJaringanController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::post('/', [KoneksiJaringanController::class, 'store'])->name('store');
                Route::put('/{id}', [KoneksiJaringanController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [KoneksiJaringanController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });
        });

        /* =======================
        |  TIM LAPANGAN (READ semua, CRUD Admin)
        ======================= */
        Route::prefix('tim-lapangan')->name('tim-lapangan.')->group(function () {
            Route::get('/', [TimLapanganController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::post('/', [TimLapanganController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [TimLapanganController::class, 'edit'])
                    ->whereNumber('id')
                    ->name('edit');
                Route::put('/{id}', [TimLapanganController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [TimLapanganController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });
        });

        /* =======================
        |  TIKET PERBAIKAN (READ semua, CRUD Admin)
        |  FIX: route khusus HARUS sebelum /{id}
        ======================= */
        Route::prefix('tiket-perbaikan')->name('tiket-perbaikan.')->group(function () {
            Route::get('/', [TiketPerbaikanController::class, 'index'])->name('index');

            Route::middleware(['role:Admin'])->group(function () {
                Route::get('/get-verified-aduan', [TiketPerbaikanController::class, 'getVerifiedAduan'])
                    ->name('get-verified-aduan');

                Route::post('/', [TiketPerbaikanController::class, 'store'])->name('store');
                Route::put('/{id}', [TiketPerbaikanController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [TiketPerbaikanController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });

            Route::get('/{id}', [TiketPerbaikanController::class, 'show'])
                ->whereNumber('id')
                ->name('show');
        });

        /* =======================
        |  PROGRES PENGERJAAN
        |  READ semua, CRUD Admin|Teknisi
        ======================= */
        Route::prefix('progres-pengerjaan')->name('progres-pengerjaan.')->group(function () {
            Route::get('/', [ProgresPengerjaanController::class, 'index'])->name('index');
            Route::get('/{asetPjuId}', [ProgresPengerjaanController::class, 'show'])
                ->whereNumber('asetPjuId')
                ->name('show');

            Route::middleware(['role:Admin|Teknisi'])->group(function () {
                Route::post('/', [ProgresPengerjaanController::class, 'store'])->name('store');
                Route::put('/{id}', [ProgresPengerjaanController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                    Route::delete('/{id}', [ProgresPengerjaanController::class, 'destroy'])
            ->whereNumber('id')
            ->name('destroy');
            });
        });

        /* =======================
        |  TINDAKAN TEKNISI
        |  READ semua, CRUD Admin|Teknisi
        ======================= */
        Route::prefix('tindakan-teknisi')->name('tindakan-teknisi.')->group(function () {
            Route::get('/', [TindakanTeknisiController::class, 'index'])->name('index');
            Route::get('/{id}', [TindakanTeknisiController::class, 'show'])
                ->whereNumber('id')
                ->name('show');

            Route::middleware(['role:Admin|Teknisi'])->group(function () {
                Route::post('/', [TindakanTeknisiController::class, 'store'])->name('store');
                Route::put('/{id}', [TindakanTeknisiController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [TindakanTeknisiController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });
        });

        /* =======================
        |  LOG SURVEY
        |  READ semua, CRUD Admin|Survey
        ======================= */
        Route::prefix('log-survey')->name('log-survey.')->group(function () {
            Route::get('/', [LogSurveyController::class, 'index'])->name('index');

            Route::middleware(['role:Admin|Survey'])->group(function () {
                Route::post('/', [LogSurveyController::class, 'store'])->name('store');
                Route::put('/{id}', [LogSurveyController::class, 'update'])
                    ->whereNumber('id')
                    ->name('update');
                Route::delete('/{id}', [LogSurveyController::class, 'destroy'])
                    ->whereNumber('id')
                    ->name('destroy');
            });
        });

        /* =======================
        |  PROFILE (semua role login boleh)
        ======================= */
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        /* =======================
        |  SETTINGS
        |  - Users: read untuk role lain (permission read), create/update/delete sesuai permission
        |  - Roles/Navs/Preferences: Admin saja
        ======================= */
        Route::prefix('settings')->name('settings.')->group(function () {

            // USERS (READ)
            Route::get('users', [UsersController::class, 'index'])
                ->name('users.index')
                ->middleware('permission:settings-users.read');

            // USERS (CREATE)
            Route::post('users', [UsersController::class, 'store'])
                ->name('users.store')
                ->middleware('permission:settings-users.create');

            // USERS (EDIT/UPDATE)
            Route::get('users/{user}/edit', [UsersController::class, 'edit'])
                ->name('users.edit')
                ->middleware('permission:settings-users.update');

            Route::put('users/{user}', [UsersController::class, 'update'])
                ->name('users.update')
                ->middleware('permission:settings-users.update');

            // USERS (DELETE)
            Route::delete('users/{user}', [UsersController::class, 'destroy'])
                ->name('users.destroy')
                ->middleware('permission:settings-users.delete');

            // SETTINGS LAIN: ADMIN ONLY
            Route::middleware(['role:Admin'])->group(function () {
                Route::resource('roles', RolesController::class);
                Route::put('roles/{role}/permissions', [RolesController::class, 'givePermission'])
                    ->name('roles.permissions');
                Route::resource('navs', NavigationsController::class);
                Route::resource('preferences', PreferencesController::class);
            });
        });
    });
});

/* =======================
|  AUTH & LOCALE
======================= */
require __DIR__ . '/auth.php';

Route::get('change-locale/{lang}', [LocaleController::class, 'changeLocale'])
    ->name('change-locale');
