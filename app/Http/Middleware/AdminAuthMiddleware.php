<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;  // Tambahkan ini
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminAuthMiddleware is being called.');

        $token = $request->bearerToken();
        if (!$token) {
            Log::info('Unauthorized access attempt: No token provided.');

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
            ], 401);
        }

        $hashedToken = hash('sha256', $token);

        // Verifikasi token menggunakan Sanctum
        $personalAccessToken = PersonalAccessToken::where('token', $hashedToken)->first();
        if (!$personalAccessToken || !$personalAccessToken->tokenable) {
            Log::info('Unauthorized access attempt.', ['token' => $hashedToken]);

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access',
            ], 401);
        }

        // Token valid, lanjutkan permintaan
        return $next($request);
    }
}
