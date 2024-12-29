<?php

namespace App\Http\Controllers;

use App\Models\Proprietaire;
use App\Http\Requests\ProprietaireRequest;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $proprietaires = Proprietaire::all();

        
        return view('proprietaires.index', compact('proprietaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('proprietaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProprietaireRequest $request)
    {
        Proprietaire::create($request->validated());
        return redirect()->route('proprietaires.index')->with('success', 'Propriétaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $proprietaire = Proprietaire::findOrFail($id);

        
        return view('proprietaires.show', compact('proprietaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $proprietaire = Proprietaire::findOrFail($id);

        
        return view('proprietaires.edit', compact('proprietaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProprietaireRequest $request, string $id)
    {
        $proprietaire = Proprietaire::findOrFail($id);
        $proprietaire->update($request->validated());
        return redirect()->route('proprietaires.index')->with('success', 'Propriétaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $proprietaire = Proprietaire::findOrFail($id);

        
        $proprietaire->delete();

        
        return redirect()->route('proprietaires.index')->with('success', 'Propriétaire supprimé avec succès.');
    }
}
