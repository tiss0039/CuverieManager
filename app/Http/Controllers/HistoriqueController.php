<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\Employe;
use App\Http\Requests\HistoriqueRequest; 

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historiques = Historique::with('employe')->get();
        return view('historiques.index', compact('historiques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employes = Employe::all();
        return view('historiques.create', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HistoriqueRequest $request) // Utilisation de HistoriqueRequest
    {
        Historique::create($request->validated());
        return redirect()->route('historiques.index')->with('success', 'Historique ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $historique = Historique::findOrFail($id);
        $employes = Employe::all();

        return view('historiques.edit', compact('historique', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HistoriqueRequest $request, string $id) // Utilisation de HistoriqueRequest
    {
        $historique = Historique::findOrFail($id);
        $historique->update($request->validated());
        return redirect()->route('historiques.index')->with('success', 'Historique mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $historique = Historique::findOrFail($id);
        $historique->delete();

        return redirect()->route('historiques.index')->with('success', 'Historique supprimé avec succès.');
    }
}


