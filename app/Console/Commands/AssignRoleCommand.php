<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AssignRoleCommand extends Command
{
    protected $signature = 'user:assign-role {userId} {role}';
    protected $description = 'Assign a role to a user (admin or user)';

    public function handle()
    {
        $userId = $this->argument('userId');
        $role = $this->argument('role');

        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found.");
            return 1;
        }

        if (!in_array($role, ['admin', 'user'])) {
            $this->error("Role must be 'admin' or 'user'.");
            return 1;
        }

        $user->assignRole($role);
        $this->info("Role '{$role}' assigned to user '{$user->name}' successfully.");
        return 0;
    }
}
