<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions grouped by module
        $permissions = [
            // User management
            'manage users',
            'view users',

            // Book management
            'manage books',
            'view books',
            'import books',
            'export books',

            // Author management
            'manage authors',
            'view authors',

            // Publisher management
            'manage publishers',
            'view publishers',

            // Category management
            'manage categories',
            'view categories',

            // Book rack management
            'manage book racks',
            'view book racks',

            // Member management
            'manage members',
            'view members',
            'import members',
            'export members',

            // Borrowing management
            'manage borrowings',
            'view borrowings',
            'create borrowings',

            // Return management
            'manage returns',
            'view returns',
            'create returns',

            // Reports
            'view reports',
            'export reports',

            // Activity log
            'view activity logs',

            // Dashboard
            'view dashboard',
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions($permissions);

        $petugas = Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
        $petugas->syncPermissions([
            'manage books',
            'view books',
            'import books',
            'export books',
            'manage authors',
            'view authors',
            'manage publishers',
            'view publishers',
            'manage categories',
            'view categories',
            'manage book racks',
            'view book racks',
            'manage members',
            'view members',
            'import members',
            'export members',
            'manage borrowings',
            'view borrowings',
            'create borrowings',
            'manage returns',
            'view returns',
            'create returns',
            'view reports',
            'export reports',
            'view dashboard',
        ]);

        $siswa = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        $siswa->syncPermissions([
            'view books',
            'view categories',
            'view authors',
            'view publishers',
            'view borrowings',
        ]);
    }
}
