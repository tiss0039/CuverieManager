<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cuve;

class CuvePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager', 'Caviste']);
    }

    public function view(User $user, Cuve $cuve)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager', 'Caviste']);
    }

    public function create(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function update(User $user, Cuve $cuve)
    {
        return $user->hasRole('Administrateur');
    }

    public function delete(User $user, Cuve $cuve)
    {
        return $user->hasRole('Administrateur');
    }
}


