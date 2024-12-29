<?php

namespace App\Http\Controllers;

use App\Models\Mout;
use App\Models\Cuve;
use App\Models\Proprietaire;
use App\Http\Requests\MoutRequest;

class MoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
        $mouts = Mout::with(['cuve', 'proprietaire'])->get();

        
        return view('mouts.index', compact('mouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cuves = Cuve::all();
        $proprietaires = Proprietaire::all();
        return view('mouts.create', compact('cuves', 'proprietaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MoutRequest $request)
    {
        
        Mout::create($request->validated());

        
        return redirect()->route('mouts.index')->with('success', 'Moût ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mout = Mout::findOrFail($id);
        return view('mouts.show', compact('mout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mout = Mout::findOrFail($id);
        $cuves = Cuve::all();
        $proprietaires = Proprietaire::all();

        return view('mouts.edit', compact('mout', 'cuves', 'proprietaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoutRequest $request, string $id)
    {
        $mout = Mout::findOrFail($id);
        $mout->update($request->validated());
        return redirect()->route('mouts.index')->with('success', 'Moût mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mout = Mout::findOrFail($id);
        $mout->delete();

        return redirect()->route('mouts.index')->with('success', 'Moût supprimé avec succès.');
    }
}

