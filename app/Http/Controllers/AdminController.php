<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(10); // Adjust the number 10 to the number of admins you want per page
        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'username' => 'required|unique:admins,username',
            'password' => 'required|min:6',

        ]);

        $admin = new Admin();
        $admin->nom = $request->nom;
        $admin->prenom = $request->prenom;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'username' => 'required|unique:admins,username,' . $id,
            'password' => 'required|min:6',

        ]);

        $admin = Admin::find($id);
        $admin->nom = $request->nom;
        $admin->prenom = $request->prenom;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin Updated Successfully');
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin Deleted Successfully');
    }
    public function regeneratePassword(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->route('admins.index')->with('error', 'Admin not found');
        }

        $randomString = Str::random(4);
        $newPassword = $admin->username . $randomString;
        $admin->password = Hash::make($newPassword);
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Password regenerated successfully for Admin ID: ' . $id . '. New Password: ' . $newPassword);
    }
}
