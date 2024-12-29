<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class RolePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function view(User $user, Role $role)
    {
        return $user->hasRole('Administrateur');
    }

    public function create(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function update(User $user, Role $role)
    {
        return $user->hasRole('Administrateur');
    }

    public function delete(User $user, Role $role)
    {
        return $user->hasRole('Administrateur');
    }
}

