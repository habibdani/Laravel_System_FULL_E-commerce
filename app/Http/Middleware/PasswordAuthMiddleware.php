<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PasswordAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiPassword = $request->header('X-API-Password');

        // Cek apakah password API valid
        if ($apiPassword !== config('api.password')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
            ], 401);
        }

        return $next($request);
    }
}
