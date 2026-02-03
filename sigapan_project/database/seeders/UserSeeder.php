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
        // WAJIB: reset cache spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /* =======================
        |  BUAT ROLE (SESUIAI ROUTES)
        ======================= */
        $admin    = Role::firstOrCreate(['name' => 'Admin']);
        $teknisi  = Role::firstOrCreate(['name' => 'Teknisi']);
        $survey   = Role::firstOrCreate(['name' => 'Survey']);

        /* =======================
        |  BUAT PERMISSION SETTINGS USERS
        ======================= */
        $permissions = [
            'settings-users.read',
            'settings-users.create',
            'settings-users.update',
            'settings-users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Admin FULL AKSES
        $admin->givePermissionTo($permissions);

        // Teknisi & Survey cuma READ
        $teknisi->givePermissionTo('settings-users.read');
        $survey->givePermissionTo('settings-users.read');

        /* =======================
        |  BUAT USER ADMIN
        ======================= */
        $user = User::firstOrCreate(
            ['email' => 'admin@app.test'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('123456'),
            ]
        );

        // PASTI LOLOS SEMUA ROUTE
        $user->syncRoles(['Admin']);
    }
}

