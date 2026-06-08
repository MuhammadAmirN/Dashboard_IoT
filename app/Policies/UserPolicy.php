<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if user can manage roles (Super Admin only)
     */
    public function manageRoles(User $user): bool
    {
        return $user->role === 'super_admin';
    }

    /**
     * Determine if user can view user management
     */
    public function viewManagement(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'admin']);
    }

    /**
     * Determine if user can update user role
     */
    public function updateRole(User $user, User $target): bool
    {
        // Super admin can update anyone
        if ($user->role === 'super_admin') {
            return true;
        }
        return false;
    }

    /**
     * Determine if user can delete user
     */
    public function delete(User $user, User $target): bool
    {
        return $user->role === 'super_admin' && $user->id !== $target->id;
    }
}
