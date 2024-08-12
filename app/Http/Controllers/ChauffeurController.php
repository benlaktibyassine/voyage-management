<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Chauffeur::query();

        if ($search) {
            $query->where('nom', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%")
                ->orWhere('telephone', 'LIKE', "%{$search}%");
        }

        $chauffeurs = $query->paginate(4);

        return view('chauffeurs.index', compact('chauffeurs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chauffeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image');
        $imageData = file_get_contents($image);

        Chauffeur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'image' => $imageData,
        ]);

        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chauffeur $chauffeur)
    {
        return view('chauffeurs.show', compact('chauffeur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chauffeur $chauffeur)
    {
        return view('chauffeurs.edit', compact('chauffeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chauffeur $chauffeur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:204',
        ]);
        $image = $request->file('image');
        $imageData = file_get_contents($image);
        $chauffeur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'image' => $imageData,
        ]);
        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur modifie avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur supprimé avec succès');
    }
}
