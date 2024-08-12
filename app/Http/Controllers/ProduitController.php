<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $produits = Produit::when($search, function ($query, $search) {
            return $query->where('nom', 'like', '%' . $search . '%')
                ->orWhere('prix', 'like', '%' . $search . '%');
        })->get();

        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("produits.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageData = file_get_contents($image);

        Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'image' => $imageData,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès');
    }
    public function search(Request $request)
    {
        $search = $request->query('search');
        $produits = Produit::when($search, function ($query, $search) {
            return $query->where('nom', 'like', '%' . $search . '%')
                         ->orWhere('prix', 'like', '%' . $search . '%');
        })->get();

        $view = view('produits.partials.product-list', compact('produits'))->render();
        return response()->json($view);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $produit->nom = $request->nom;
        $produit->prix = $request->prix;

        if ($request->hasFile('image')) {
            $produit->image = file_get_contents($request->file('image')->path());
        }

        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
