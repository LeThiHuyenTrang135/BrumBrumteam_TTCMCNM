<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateTestUsersSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Tạo admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password123'),
            'level' => 1,
        ]);

        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Tạo regular user
        $user = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Regular User',
            'password' => Hash::make('password123'),
            'level' => 0,
        ]);

        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        $this->command->info('Test users created successfully!');
        $this->command->info('Admin: admin@example.com | password: password123');
        $this->command->info('User: user@example.com | password: password123');
    }
}
