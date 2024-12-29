<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mout;

class MoutPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager', 'Caviste']);
    }

    public function view(User $user, Mout $mout)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager', 'Caviste']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['Administrateur', 'Caviste']);
    }

    public function update(User $user, Mout $mout)
    {
        return $user->hasAnyRole(['Administrateur', 'Caviste']);
    }

    public function delete(User $user, Mout $mout)
    {
        return $user->hasRole('Administrateur');
    }
}

