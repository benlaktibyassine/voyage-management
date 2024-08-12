<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Commande;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BonLivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = BonLivraison::query();

    // Filter by ID
    if ($search_id = $request->query('search_id')) {
        $query->where('id', 'LIKE', "%{$search_id}%");
    }

    // Filter by Date
    if ($search_date = $request->query('search_date')) {
        $query->whereDate('created_at', $search_date);
    }

    // Filter by Status
    if ($search_status = $request->query('search_status')) {
        if ($search_status === 'scaned') {
            $query->where('scaned', 1);
        } elseif ($search_status === 'not_scaned') {
            $query->where('scaned', 0);
        }
    }

    // Filter by Voyage ID
    if ($search_voyage = $request->query('search_voyage')) {
        $query->where('voyage_id', 'LIKE', "%{$search_voyage}%");
    }

    // Filter by Commande ID
    if ($search_commande = $request->query('search_commande')) {
        $query->where('cmd_id', 'LIKE', "%{$search_commande}%");
    }

    // Filter by Number of Scan Sortie
    if ($search_nbr_scanS = $request->query('search_nbr_scanS')) {
        $query->where('nbr_scanS', 'LIKE', "%{$search_nbr_scanS}%");
    }

    // Filter by Number of Scan Entrée
    if ($search_nbr_scanE = $request->query('search_nbr_scanE')) {
        $query->where('nbr_scanE', 'LIKE', "%{$search_nbr_scanE}%");
    }

    // Paginate the results
    $bonLivraisons = $query->paginate(10);

    // Pass the filtered data to the view
    return view('bl.index', compact('bonLivraisons'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandes = Commande::all();
        $voyages = Voyage::all();
        return view('bl.create', compact('commandes', 'voyages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'commande_id' => 'required|exists:commandes,id', // Ensure the commande_id exists in the commandes table
            'voyage_id' => 'required|exists:voyages,mat',     // Ensure the voyage_id exists in the voyages table
        ]);

        // Create a new BonLivraison
        $bonLivraison = new BonLivraison();
        $bonLivraison->scaned = 0;
        $bonLivraison->cmd_id = $request->commande_id;
        $bonLivraison->voyage_id = $request->voyage_id;
        $bonLivraison->save();

        // Redirect to the index page with a success message
        return redirect()->route('bon_livraisons.index')->with('success', 'Bon de livraison créé avec succès');
    }


    public function show(BonLivraison $bonLivraison)
    {
        // Eager load the details and the associated produit for each detail
        $bonLivraison->load('details.produit');

        // Fetch available products
        $availableProducts = $this->getAvailableProducts($bonLivraison->cmd_id);

        return view('bl.show', compact('bonLivraison', 'availableProducts'));
    }


    private function getAvailableProducts($commandeId)
    {
        // Define the raw SQL query
        $sql = "
        SELECT
            details_commande.produit_id,
            produits.nom,
            details_commande.quantite,
            COALESCE(SUM(details_bl.qte), 0) AS allocated_quantity
        FROM
            details_commande
        JOIN
            produits ON produits.id = details_commande.produit_id
        LEFT JOIN
            bon_livraisons ON bon_livraisons.cmd_id = details_commande.commande_id
        LEFT JOIN
            details_bl ON details_bl.id_bl = bon_livraisons.id AND details_bl.id_produit = produits.id
        WHERE
            bon_livraisons.cmd_id = ?
        GROUP BY
            details_commande.produit_id, produits.nom, details_commande.quantite;
    ";

        // Execute the query and pass the $commandeId as a parameter
        $availableProducts = DB::select($sql, [$commandeId]);

        return $availableProducts;
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BonLivraison $bonLivraison)
    {
        $commandes = Commande::all();
        $voyages = Voyage::all();
        return view('bl.edit', compact('bonLivraison','commandes','voyages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BonLivraison $bonLivraison)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'voyage_id' => 'required|exists:voyages,mat',
        ]);

        // Update the BonLivraison with validated data
        $bonLivraison->update([
            'cmd_id' => $request->commande_id,
            'voyage_id' => $request->voyage_id,
        ]);
        return redirect()->route('bon_livraisons.index')->with('success', 'Bon de livraison modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BonLivraison $bonLivraison)
    {
        $bonLivraison->delete();
        return redirect()->route('bon_livraisons.index');
    }
}
