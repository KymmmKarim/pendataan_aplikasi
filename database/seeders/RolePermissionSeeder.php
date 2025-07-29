<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $permissions = [
            'view data',
            'create data',
            'edit data',
            'delete data',

            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $superadmin->syncPermissions(Permission::all());


        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'view data', 'create data', 'edit data', 'delete data',
            'view users', 'create users', 'edit users',
        ]);


        $unitRoles = [
            'admin-unit',
        ];

        foreach ($unitRoles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions([
                'view data', 'create data', 'edit data', 'delete data',
            ]);
        }

        $user = \App\Models\User::find(1);
        if ($user) {
        $user->syncRoles(['superadmin']);
        }
    }
}
