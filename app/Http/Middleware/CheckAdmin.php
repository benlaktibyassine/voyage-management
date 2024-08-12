<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // Check if user is authenticated
        if (!Session::has('user_type') || !Session::has('user_id')) {
            return redirect()->route('loginform');
        }

        // Check if the user type matches the required type
        if (Session::get('user_type') !== $type) {
            return redirect()->route('unauthorized'); // Redirect to an unauthorized page or any other page
        }

        return $next($request);
    }
}
