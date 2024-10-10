<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the token from the Authorization header
        $token = $request->bearerToken();

        if (!$token) {
            // If no token is provided, return unauthorized response
            return response()->json(['message' => 'Token not provided'], 401);
        }

        // Hash the token for comparison with the database
        $hashedToken = hash('sha256', $token);

        // Check if the token exists in the personal_access_tokens table
        $tokenRecord = DB::table('personal_access_tokens')
            ->where('token', $hashedToken)
            ->where('tokenable_type', 'App\Models\Admin') // Ensure it's an admin token
            ->first();

        if (!$tokenRecord) {
            // If token does not exist or is invalid, return unauthorized response
            return response()->json(['message' => 'Invalid token'], 401);
        }

        // Token is valid, ensure the tokenable_id matches the correct admin
        $admin = DB::select('SELECT * FROM admins WHERE id = ?', [$tokenRecord->tokenable_id]);

        if (empty($admin)) {
            // If no admin is found for the given tokenable_id
            return response()->json(['message' => 'Admin not found'], 401);
        }

        // Token belongs to the correct admin, proceed with the request
        return $next($request);
    }
}
