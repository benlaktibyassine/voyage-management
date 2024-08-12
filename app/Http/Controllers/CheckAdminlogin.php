<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Securitie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckAdminlogin extends Controller
{
    /**
     * Handle login request for both admins and securities.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check in Admins table
        $admin = Admin::where('username', $credentials['username'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Authentication passed for Admin
            Session::put('user_type', 'admin');
            Session::put('user_id', $admin->id);
            return redirect()->route('dash');
        }

        // Check in Securities table
        $securitie = Securitie::where('username', $credentials['username'])->first();
        if ($securitie && Hash::check($credentials['password'], $securitie->password)) {
            // Authentication passed for Security
            Session::put('user_type', 'securitie');
            Session::put('user_id', $securitie->num_badge);
            return redirect()->route('securitie_dashboard'); // Redirect to a different dashboard for securities
        }

        // Authentication failed
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.']);
    }

    /**
     * Handle admin logout.
     */
    public function logout()
    {
        Session::forget('user_type');
        Session::forget('user_id');
        return redirect()->route('loginform');
    }

    /**
     * Check if user is authenticated.
     */
    public function checkAuth()
    {
        return Session::has('user_id');
    }
}
