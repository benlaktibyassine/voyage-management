<?php

namespace App\Http\Controllers;

use App\Models\Securitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SecuritieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $securities = Securitie::paginate(10);
        return view('securities.index', compact('securities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('securities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cin' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:securities',
            'password' => 'required|string|min:8',
        ]);
        // dd($request);
        // Store the new security record
        Securitie::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'CIN' => $request->cin,
            'telephone' => $request->telephone,

            'username' => $request->username,
            'password' => bcrypt($request->password), // Hashing the password
        ]);

        return redirect()->route('securities.index')->with('success', 'Sécurité ajoutée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show($num_badge)
    {
        $securitie = Securitie::find($num_badge);

        if (!$securitie) {
            return redirect()->route('securities.index')->with('error', 'Securitie not found');
        }

        return view('securities.show', compact('securitie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($num_badge)
    {
        $security = Securitie::find($num_badge);

        if (!$security) {
            return redirect()->route('securities.index')->with('error', 'Securitie not found');
        }

        return view('securities.edit', compact('security'));
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $num_badge)
{
    // Find the security record using num_badge
    $securitie = Securitie::where('num_badge', $num_badge)->first();

    if (!$securitie) {
        return redirect()->route('securities.index')->with('error', 'Securitie not found');
    }

    // Validate the request, using `ignore` for the unique fields
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'cin' => [
            'required',
            'string',
            'max:20',
            Rule::unique('securities', 'CIN')->ignore($num_badge, 'num_badge'), // Ignore current record based on num_badge
        ],
        'telephone' => 'required|string|max:20',
        'username' => [
            'required',
            'string',
            'max:255',
            Rule::unique('securities', 'username')->ignore($num_badge, 'num_badge'), // Ignore current record based on num_badge
        ],
        'password' => 'nullable|string|min:6', // Make password optional
    ]);

    // Update the security record with new values
    $securitie->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'CIN' => $request->cin, // Always update CIN if provided
        'telephone' => $request->telephone,
        'username' => $request->username, // Always update username if provided
        'password' => $request->password ? Hash::make($request->password) : $securitie->password, // Hash new password if provided, otherwise keep existing
    ]);

    return redirect()->route('securities.index')->with('success', 'Securitie mis à jour avec succès');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($num_badge)
    {
        $securitie = Securitie::find($num_badge);

        if (!$securitie) {
            return redirect()->route('securities.index')->with('error', 'Securitie not found');
        }

        $securitie->delete();
        return redirect()->route('securities.index')->with('success', 'Securitie supprimé avec succès');
    }
}
