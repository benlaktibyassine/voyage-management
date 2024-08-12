<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    public function scan(Request $request, $badge, $status)
    {
        // Validate the request to ensure 'mat' is provided and exists in the voyages table
        $request->validate([
            'mat' => 'required|string|exists:voyages,mat',
        ]);

        $mat = $request->mat;
        $securityBadge = $badge;

        // Retrieve the voyage by its mat
        $voyage = Voyage::where('mat', $mat)->first();

        // If voyage does not exist, return an error response
        if (!$voyage) {
            return redirect()->back()->withErrors(['error' => 'Voyage not found.']);
        }

        $currentDateTime = now();
        $message = ''; // Initialize message variable
        $statu = 0;
        DB::transaction(function () use ($voyage, $currentDateTime, $securityBadge, $status, &$message) {
            // Update voyage dates based on the status
            if ($status === 'sortie') {
                if (is_null($voyage->scanS_date)) {
                    // Update scanS_date to current date time
                    $voyage->scanS_date = $currentDateTime;
                    $voyage->save();

                    // Insert into historique table
                    DB::table('historiques')->insert([
                        'voyage_mat' => $voyage->mat,
                        'security_badge' => $securityBadge,
                        'status' => 'sortie',
                        'created_at' => $currentDateTime,
                        'updated_at' => $currentDateTime,
                    ]);

                    // Optionally update the bon_livraisons table if needed
                    DB::statement('UPDATE bon_livraisons SET scaned = 1, nbr_scanS = nbr_scanS + 1 WHERE voyage_id = ?', [$voyage->mat]);
                    $statu = 1;
                    $message = 'Voyage marker sortie avec succées.';
                } else {
                    // Handle case where scanS_date is already set
                    DB::table('historiques')->insert([
                        'voyage_mat' => $voyage->mat,
                        'security_badge' => $securityBadge,
                        'status' => 'erreur',
                        'created_at' => $currentDateTime,
                        'updated_at' => $currentDateTime,
                    ]);
                    DB::statement('UPDATE bon_livraisons SET  nbr_scanS = nbr_scanS + 1 WHERE voyage_id = ?', [$voyage->mat]);
                    $statu = 0;
                    $message = 'Erreur: La sortie de ce voyage est déjà marker.';
                }
            } elseif ($status === 'entree') {
                if (is_null($voyage->scanE_date)) {
                    // Update scanE_date to current date time
                    $voyage->scanE_date = $currentDateTime;
                    $voyage->save();

                    // Insert into historique table
                    DB::table('historiques')->insert([
                        'voyage_mat' => $voyage->mat,
                        'security_badge' => $securityBadge,
                        'status' => 'entree',
                        'created_at' => $currentDateTime,
                        'updated_at' => $currentDateTime,
                    ]);

                    DB::statement('UPDATE bon_livraisons SET nbr_scanE = nbr_scanE + 1 WHERE voyage_id = ?', [$voyage->mat]);
                    $statu = 1;
                    $message = 'Voyage marker en entrée avec succées.';
                } else {
                    // Handle case where scanE_date is already set
                    DB::table('historiques')->insert([
                        'voyage_mat' => $voyage->mat,
                        'security_badge' => $securityBadge,
                        'status' => 'erreur',
                        'created_at' => $currentDateTime,
                        'updated_at' => $currentDateTime,
                    ]);

                    DB::statement('UPDATE bon_livraisons SET nbr_scanE = nbr_scanE + 1 WHERE voyage_id = ?', [$voyage->mat]);
                    $statu = 0;
                    $message = "Erreur: L'Entrée de ce voyage est déjà marker.";
                }
            } else {
                DB::table('historiques')->insert([
                    'voyage_mat' => $voyage->mat,
                    'security_badge' => $securityBadge,
                    'status' => 'erreur',
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime,
                ]);
                $statu = 0;
                $message = 'Error: Unknown status provided.';
            }
        });
        return redirect()->back()->with([
            'statu' => $statu,
            'message' => $message
        ]);
    }
    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginform');
    }
}
