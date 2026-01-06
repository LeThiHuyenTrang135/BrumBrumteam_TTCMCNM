<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'manage products']);
        Permission::firstOrCreate(['name' => 'view products']);
        Permission::firstOrCreate(['name' => 'manage users']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(['manage products', 'view products', 'manage users']);

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->givePermissionTo(['view products']);
    }
}
