<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PjuNavigationSeeder extends Seeder
{
    public function run()
    {
        // ====================================================================
        // PARENT MENU: Manajemen PJU
        // ====================================================================
        $pjuManagement = DB::table('navigations')->insertGetId([
            'name' => 'Manajemen PJU',
            'slug' => 'manajemen-pju',
            'url' => '#',
            'icon' => 'lightbulb',
            'parent_id' => null,
            'order' => 30, // Sesuaikan dengan urutan yang diinginkan
            'active' => 1,
            'display' => 1,
            'page' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ====================================================================
        // CHILD MENUS
        // ====================================================================
        
        // 1. Tim Lapangan
        DB::table('navigations')->insert([
            'name' => 'Tim Lapangan',
            'slug' => 'tim-lapangan',
            'url' => 'admin.tim-lapangan.index',
            'icon' => null,
            'parent_id' => $pjuManagement,
            'order' => 1,
            'active' => 1,
            'display' => 1,
            'page' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Log Survey
        DB::table('navigations')->insert([
            'name' => 'Log Survey',
            'slug' => 'log-survey',
            'url' => 'admin.log-survey.index',
            'icon' => null,
            'parent_id' => $pjuManagement,
            'order' => 2,
            'active' => 1,
            'display' => 1,
            'page' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Tiket Perbaikan
        DB::table('navigations')->insert([
            'name' => 'Tiket Perbaikan',
            'slug' => 'tiket-perbaikan',
            'url' => 'admin.tiket-perbaikan.index',
            'icon' => null,
            'parent_id' => $pjuManagement,
            'order' => 3,
            'active' => 1,
            'display' => 1,
            'page' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Progres Pengerjaan
        DB::table('navigations')->insert([
            'name' => 'Progres Pengerjaan',
            'slug' => 'progres-pengerjaan',
            'url' => 'admin.progres-pengerjaan.index',
            'icon' => null,
            'parent_id' => $pjuManagement,
            'order' => 4,
            'active' => 1,
            'display' => 1,
            'page' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ====================================================================
        // PERMISSIONS FOR EACH MENU
        // ====================================================================
        
        $permissions = [
            // Tim Lapangan Permissions
            'tim-lapangan.read',
            'tim-lapangan.create',
            'tim-lapangan.update',
            'tim-lapangan.delete',
            
            // Log Survey Permissions
            'log-survey.read',
            'log-survey.create',
            'log-survey.update',
            'log-survey.delete',
            
            // Tiket Perbaikan Permissions
            'tiket-perbaikan.read',
            'tiket-perbaikan.create',
            'tiket-perbaikan.update',
            'tiket-perbaikan.delete',
            
            // Progres Pengerjaan Permissions
            'progres-pengerjaan.read',
            'progres-pengerjaan.create',
            'progres-pengerjaan.update',
            'progres-pengerjaan.delete',
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ====================================================================
        // ASSIGN PERMISSIONS TO SUPERADMIN ROLE
        // ====================================================================
        $superadminRole = DB::table('roles')->where('name', 'superadmin')->first();
        
        if ($superadminRole) {
            $permissionIds = DB::table('permissions')
                ->whereIn('name', $permissions)
                ->pluck('id');

            foreach ($permissionIds as $permissionId) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permissionId,
                    'role_id' => $superadminRole->id,
                ]);
            }
        }
    }
}
