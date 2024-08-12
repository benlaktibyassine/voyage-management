<?php


namespace App\Http\Controllers;


use App\Models\BonLivraison;
use App\Models\Detail_bl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Detail_blController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'bl_id' => 'required|exists:bon_livraisons,id',
            'produit_id' => 'required|exists:produits,id',
            'quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $blId = $request->input('bl_id');
                    $produitId = $request->input('produit_id');

                    $totalQuantity = DB::table('details_commande')
                        ->where('commande_id', function ($query) use ($blId) {
                            $query->select('cmd_id')
                                ->from('bon_livraisons')
                                ->where('id', $blId);
                        })
                        ->where('produit_id', $produitId)
                        ->value('quantite');

                    $allocatedQuantity = DB::table('details_bl')
                        ->join('bon_livraisons', 'details_bl.id_bl', '=', 'bon_livraisons.id')
                        ->where('details_bl.id_produit', $produitId)
                        ->where('bon_livraisons.cmd_id', $blId)
                        ->sum('details_bl.qte');

                    $availableQuantity = $totalQuantity - $allocatedQuantity;

                    if ($value > $availableQuantity) {
                        $fail("La quantité demandée dépasse la quantité disponible.");
                    }
                },
            ],
        ]);

        // Create a new Detail_bl record
        Detail_bl::create([
            'id_bl' => $request->input('bl_id'),
            'id_produit' => $request->input('produit_id'),
            'qte' => $request->input('quantity'),
        ]);

        // Redirect to the show page of the BonLivraison with a success message
        return redirect()->route('bon_livraisons.show', ['bon_livraison' => $request->input('bl_id')])
            ->with('success', 'Détail du Bon de Livraison ajouté avec succès');
    }
    public function destroy($id)
    {
        // Find the Detail_bl by ID and delete it
        $detail = Detail_bl::findOrFail($id);
        $detail->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Produit supprimé avec succès.');
    }
}
