<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Historique;

class HistoriquePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager']);
    }

    public function view(User $user, Historique $historique)
    {
        return $user->hasAnyRole(['Administrateur', 'Manager']);
    }

    public function create(User $user)
    {
        return $user->hasRole('Administrateur');
    }

    public function update(User $user, Historique $historique)
    {
        return $user->hasRole('Administrateur');
    }

    public function delete(User $user, Historique $historique)
    {
        return $user->hasRole('Administrateur');
    }
}

