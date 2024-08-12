<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Commande::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('description', 'like', "%{$search}%")
                ->orWhere('etat', 'like', "%{$search}%")
                ->orWhere('id','like', "%{$search}%")
                ->orWhereHas('client', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%");
                });
        }

        $commandes = $query->paginate(8);

        return view('commandes.index', compact('commandes'));
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('search');
            $commandes = Commande::where('description', 'like', "%{$query}%")
                ->orWhere('etat', 'like', "%{$query}%")
                ->orWhereHas('client', function ($q) use ($query) {
                    $q->where('nom', 'like', "%{$query}%")
                      ->orWhere('prenom', 'like', "%{$query}%");
                })->get();

            return view('commandes.partials.commandes-table', compact('commandes'))->render();
        }
    }


    public function show(Commande $commande)
    {
        $commande->load('detailsCommandes.produit');
        return view('commandes.show', compact('commande'));
    }
}
