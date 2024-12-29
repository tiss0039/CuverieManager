<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employe;

class EmployePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function view(User $user, Employe $employe)
    {
        return $user->hasRole('Administrateur');
    }

    public function create(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function update(User $user, Employe $employe)
    {
        return $user->hasRole('Administrateur');
    }

    public function delete(User $user, Employe $employe)
    {
        return $user->hasRole('Administrateur');
    }
}

