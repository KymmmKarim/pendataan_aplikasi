<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permission
        $permissions = [
            'view data',
            'create data',
            'edit data',
            'delete data',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Berikan semua permission ke role admin
        $adminRole->syncPermissions(Permission::all());

        // Assign role admin ke user pertama (opsional)
        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}