<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Import model Admin

class EnsureAdminIsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the authenticated user's email or id is in the admins table
            $admin = Admin::where('id', Auth::id())->orWhere('email', Auth::user()->email)->first();

            if ($admin) {
                return $next($request);
            }
        }

        // Return unauthorized response if not an admin
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
