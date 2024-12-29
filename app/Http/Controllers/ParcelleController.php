<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use App\Models\Proprietaire;
use App\Http\Requests\ParcelleRequest;

class ParcelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupération des parcelles avec leur propriétaire
        $parcelles = Parcelle::with('proprietaire')->get();
        return view('parcelles.index', compact('parcelles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proprietaires = Proprietaire::all();
        return view('parcelles.create', compact('proprietaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParcelleRequest $request)
    {
        // Les données sont validées par ParcelleRequest
        Parcelle::create($request->validated());
        return redirect()->route('parcelles.index')->with('success', 'Parcelle ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parcelle = Parcelle::with('proprietaire')->findOrFail($id);
        return view('parcelles.show', compact('parcelle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        $proprietaires = Proprietaire::all();
        return view('parcelles.edit', compact('parcelle', 'proprietaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParcelleRequest $request, string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        $parcelle->update($request->validated());
        return redirect()->route('parcelles.index')->with('success', 'Parcelle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        $parcelle->delete();
        return redirect()->route('parcelles.index')->with('success', 'Parcelle supprimée avec succès.');
    }
}

