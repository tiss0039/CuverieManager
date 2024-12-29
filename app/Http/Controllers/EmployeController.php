<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Role;
use App\Http\Requests\EmployeRequest; 

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::with('role')->get();
        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('employes.create', compact('roles'));
    }

    public function store(EmployeRequest $request) 
    {
        Employe::create($request->validated());
        return redirect()->route('employes.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function show(string $id)
    {
        $employe = Employe::findOrFail($id);
        return view('employes.show', compact('employe'));
    }

    public function edit(string $id)
    {
        $employe = Employe::findOrFail($id);
        $roles = Role::all();
        return view('employes.edit', compact('employe', 'roles'));
    }

    public function update(EmployeRequest $request, string $id) 
    {
        $employe = Employe::findOrFail($id);
        $employe->update($request->validated());
        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}
