<?php

namespace App\Http\Controllers;

use App\Models\Cuve;
use App\Http\Requests\CuveRequest; // Import de la classe CuveRequest

class CuveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $cuves = Cuve::all();

        
        return view('cuves.index', compact('cuves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cuves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CuveRequest $request) // Utilisation de CuveRequest
    {
        Cuve::create($request->validated());
        return redirect()->route('cuves.index')->with('success', 'Cuve ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cuve = Cuve::findOrFail($id);

        
        return view('cuves.show', compact('cuve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cuve = Cuve::findOrFail($id);

        
        return view('cuves.edit', compact('cuve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CuveRequest $request, string $id) 
    {
        $cuve = Cuve::findOrFail($id);
        $cuve->update($request->validated());
        return redirect()->route('cuves.index')->with('success', 'Cuve mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cuve = Cuve::findOrFail($id);
        $cuve->delete();

        return redirect()->route('cuves.index')->with('success', 'Cuve supprimée avec succès.');
    }
}
