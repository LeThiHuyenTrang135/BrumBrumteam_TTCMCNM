<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PermissionService
{
    /**
     * Check if current user has admin role
     */
    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    /**
     * Check if current user has a specific role
     */
    public static function hasRole(string $role): bool
    {
        return Auth::check() && Auth::user()->hasRole($role);
    }

    /**
     * Check if current user has a specific permission
     */
    public static function hasPermission(string $permission): bool
    {
        return Auth::check() && Auth::user()->hasPermissionTo($permission);
    }

    /**
     * Check if current user has any of the given roles
     */
    public static function hasAnyRole(...$roles): bool
    {
        return Auth::check() && Auth::user()->hasAnyRole($roles);
    }
}
