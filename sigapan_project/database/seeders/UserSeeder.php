<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // WAJIB: reset cache spatie agar perubahan langsung terbaca
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /* =======================
        |  1. BUAT ROLE
        ======================= */
        $admin    = Role::firstOrCreate(['name' => 'Admin']);
        $teknisi  = Role::firstOrCreate(['name' => 'Teknisi']);
        $survey   = Role::firstOrCreate(['name' => 'Survey']);

        /* =======================
        |  2. DAFTAR SEMUA PERMISSION 
        |  (Format slug.read agar nyambung ke NavigationComposer)
        ======================= */
        $permissions = [
            // Menu Umum (Wajib ada agar menu muncul di sidebar)
            'dashboard.read',
            'profile.read',

            // Menu User Settings
            'settings-users.read',
            'settings-users.create',
            'settings-users.update',
            'settings-users.delete',

            // Menu Khusus Teknisi (Sesuaikan slug di tabel navigations)
            'tindakan-teknisi.read',
            'progres-pengerjaan.read',

            // Menu Khusus Survey (Sesuaikan slug di tabel navigations)
            'log-survey.read',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /* =======================
        |  3. PEMBAGIAN HAK AKSES
        ======================= */

        // ADMIN: Berikan SEMUA permission
        $admin->syncPermissions($permissions);

        // TEKNISI: Dashboard, Profile, dan Fitur Teknisi
        $teknisi->syncPermissions([
            'dashboard.read',
            'profile.read',
            'settings-users.read',
            'tindakan-teknisi.read',
            'progres-pengerjaan.read',
        ]);

        // SURVEY: Dashboard, Profile, dan Fitur Survey
        $survey->syncPermissions([
            'dashboard.read',
            'profile.read',
            'settings-users.read',
            'log-survey.read',
        ]);

        /* =======================
        |  4. BUAT USER CONTOH (Untuk Testing)
        ======================= */
        
        // Admin Utama
        $userAdmin = User::firstOrCreate(
            ['email' => 'admin@app.test'],
            ['name' => 'Admin Utama', 'password' => Hash::make('123456')]
        );
        $userAdmin->syncRoles(['Admin']);

        // User Teknisi
        $userTeknisi = User::firstOrCreate(
            ['email' => 'teknisi@app.test'],
            ['name' => 'Petugas Teknisi', 'password' => Hash::make('123456')]
        );
        $userTeknisi->syncRoles(['Teknisi']);

        // User Surveyor
        $userSurvey = User::firstOrCreate(
            ['email' => 'surveyor@app.test'],
            ['name' => 'Petugas Survey', 'password' => Hash::make('123456')]
        );
        $userSurvey->syncRoles(['Survey']);
    }
}