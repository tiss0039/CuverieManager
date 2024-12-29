<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();
    
            // Redirection en fonction du rôle
            if ($user->role->nom_role === 'Administrateur') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role->nom_role === 'Manager') {
                return redirect()->route('manager.dashboard');
            } elseif ($user->role->nom_role === 'Caviste') {
                return redirect()->route('caviste.dashboard');
            }
    
            // Par défaut, redirige vers la page d'accueil
            return redirect('/');
        }
    
        return back()->withErrors([
            'email' => 'Les informations d’identification fournies ne sont pas correctes.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
