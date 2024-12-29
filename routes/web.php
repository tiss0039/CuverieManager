<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CuveController;
use App\Http\Controllers\MoutController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ParcelleController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\HistoriqueController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

// Page d'accueil
Route::get('/', function () {
    return redirect()->route('login');
});

// Tableau de bord (dashboard)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role->nom_role === 'Administrateur') {
            return redirect()->route('admin.dashboard'); // Redirection vers le dashboard admin
        } elseif ($user->role->nom_role === 'Manager') {
            return redirect()->route('manager.dashboard'); // Redirection vers le dashboard manager
        } elseif ($user->role->nom_role === 'Caviste') {
            return redirect()->route('caviste.dashboard'); // Redirection vers le dashboard caviste
        }

        abort(403, 'Accès interdit.');
    })->name('dashboard');
});

// Gestion du profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour l'Administrateur
Route::middleware(['auth', 'can:manage-users-and-roles'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('proprietaires', ProprietaireController::class);
    Route::resource('parcelles', ParcelleController::class);
    Route::resource('historiques', HistoriqueController::class);
    Route::resource('employes', EmployeController::class);
    Route::resource('cuves', CuveController::class);
});

// Routes pour le Manager
Route::middleware(['auth', 'can:manage-fournisseurs'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');

    Route::resource('proprietaires', ProprietaireController::class);
    Route::resource('parcelles', ParcelleController::class);
    Route::resource('historiques', HistoriqueController::class);
});

// Routes pour le Caviste
Route::middleware(['auth', 'can:view-and-edit-mouts'])->group(function () {
    Route::get('/caviste/dashboard', function () {
        return view('caviste.dashboard');
    })->name('caviste.dashboard');

    Route::resource('mouts', MoutController::class);
});


require __DIR__ . '/auth.php';
