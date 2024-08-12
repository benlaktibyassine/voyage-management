<?php

namespace App\Http\Controllers;

use App\Models\BonLivraison;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;
class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Voyage::query();

        // Filter by Maticule
        if ($search_mat = $request->query('search_mat')) {
            $query->where('mat', 'LIKE', "%{$search_mat}%");
        }

        // Filter by Scan S Date
        if ($search_scanS_date = $request->query('search_scanS_date')) {
            $query->whereDate('scanS_date', $search_scanS_date);
        }

        // Filter by Scan E Date
        if ($search_scanE_date = $request->query('search_scanE_date')) {
            $query->whereDate('scanE_date', $search_scanE_date);
        }

        // Filter by Chauffeur ID
        if ($search_chauffeur_id = $request->query('search_chauffeur_id')) {
            $query->where('chauffeur_id', 'LIKE', "%{$search_chauffeur_id}%");
        }

        // Filter by Camion ID
        if ($search_camion_id = $request->query('search_camion_id')) {
            $query->where('camion_id', 'LIKE', "%{$search_camion_id}%");
        }

        $voyages = $query->paginate(10);

        return view('voyages.index', compact('voyages'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chauffeurs = DB::table('chauffeurs')->get();
        $camions = DB::table('camions')->get();
        return view('voyages.create', compact('chauffeurs', 'camions'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'chauffeur_id' => 'required|integer',
            'camion_id' => 'required|integer',
        ]);

        // Create a new Voyage
        $voyage = new Voyage();
        $voyage->chauffeur_id = $request->chauffeur_id;
        $voyage->camion_id = $request->camion_id;
        $voyage->save();

        // Generate the QR code URL
        // $qrCodeUrl = route('voyages.scan', ['voyage' => $voyage->mat]);

        // Generate and save the QR code using GD
        $qrCode = QrCode::format('svg')->size(300)->generate($voyage->mat);

        // Save the QR code as base64 in the database
        $voyage->codeqr = base64_encode($qrCode);
        $voyage->save();

        return redirect()->route('voyages.index')->with('success', 'Voyage créé avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show($mat)
    {
        $voyage = Voyage::with('chauffeur', 'camion')->find($mat);
        if (!$voyage) {
            return redirect()->route('voyages.index')->with('error', 'Voyage not found');
        }

        // Fetch all BonLivraison entries associated with this Voyage
        $bonLivraisons = DB::table('bon_livraisons')
            ->where('voyage_id', '=', $voyage->mat)
            ->get();

        // Pass the Voyage, Chauffeur, Camion, and BonLivraisons to the view
        return view('voyages.show', compact('voyage', 'bonLivraisons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($mat)
    {
        $voyage = Voyage::findOrFail($mat);
        $chauffeurs = DB::table('chauffeurs')->get();
        $camions = DB::table('camions')->get();
        return view('voyages.edit', compact('voyage', 'chauffeurs', 'camions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voyage $voyage)
    {
        // Validate the incoming request
        $request->validate([
            'chauffeur_id' => 'required|integer|exists:chauffeurs,id',
            'camion_id' => 'required|integer|exists:camions,id',
        ]);

        // Update the Voyage
        $voyage->chauffeur_id = $request->chauffeur_id;
        $voyage->camion_id = $request->camion_id;
        $voyage->save();

        $qrCode = QrCode::format('svg')->size(300)->generate($voyage->mat);

        // Save the QR code as base64 in the database
        $voyage->codeqr = base64_encode($qrCode);
        $voyage->save();

        return redirect()->route('voyages.index')->with('success', 'Voyage mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mat)
    {
        $voyage = Voyage::find($mat);
        if (!$voyage) {
            return redirect()->route('voyages.index')->with('error', 'Voyage not found');
        }

        $voyage->delete();
        return redirect()->route('voyages.index')->with('success', 'Voyage supprimé avec succès');
    }
}
