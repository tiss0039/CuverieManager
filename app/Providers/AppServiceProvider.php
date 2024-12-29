<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Permissions globales pour les Administrateurs
        Gate::before(function (User $user) {
            if ($user->hasRole('Administrateur')) {
                return true; // L'administrateur peut tout faire
            }
        });

        // Permissions pour les Cuvistes
        Gate::define('view-and-edit-mouts', function (User $user) {
            return $user->hasRole('Caviste');
        });

        // Permissions pour les Administrateurs - Gestion des cuves
        Gate::define('manage-cuves', function (User $user) {
            return $user->hasRole('Administrateur');
        });

        // Permissions pour les Administrateurs - Gestion des utilisateurs et des rôles
        Gate::define('manage-users-and-roles', function (User $user) {
            return $user->hasRole('Administrateur');
        });

        // Permissions pour les Administrateurs - Visualisation de l'historique complet
        Gate::define('view-full-historique', function (User $user) {
            return $user->hasRole('Administrateur');
        });

        // Permissions pour les Managers
        Gate::define('view-cuves-and-mouts', function (User $user) {
            return $user->hasRole('Manager');
        });

        Gate::define('manage-fournisseurs', function (User $user) {
            return $user->hasRole('Manager');
        });
    }
}

