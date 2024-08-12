<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use Illuminate\Http\Request;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camions = Camion::paginate(8);
        return view('camions.index', compact('camions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('camions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
        ]);

        $camion = new Camion();
        $camion->matricule = $request->matricule;
        $camion->marque = $request->marque;
        $camion->modele = $request->modele;
        $camion->save();

        return redirect()->route('camions.index')->with('success', 'Camion ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Camion $camion)
    {
        return view('camions.show', compact('camion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Camion $camion)
    {
        return view('camions.edit', compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camion $camion)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
        ]);

        $camion->matricule = $request->matricule;
        $camion->marque = $request->marque;
        $camion->modele = $request->modele;
        $camion->save();

        return redirect()->route('camions.index')->with('success', 'Camion modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camion $camion)
    {
        $camion->delete();
        return redirect()->route('camions.index')->with('success', 'Camion supprimé avec succès');
    }
}
