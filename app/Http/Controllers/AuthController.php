<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponseHelper;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Fetch admin using raw query
        $admin = DB::select('SELECT * FROM admins WHERE email = ?', [$request->email]);

        if (empty($admin) || !Hash::check($request->password, $admin[0]->password)) {
            return ApiResponseHelper::error('Invalid credentials', 401);
        }

        // Create token using raw query (assuming you're using Laravel Sanctum for tokens)
        $token = $admin[0]->id . '|' . base64_encode(Str::random(40)); // Use Str::random instead of str_random
        DB::insert('INSERT INTO personal_access_tokens (tokenable_id, tokenable_type, name, token, abilities, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())', [
            $admin[0]->id,
            'App\Models\Admin',
            'admin-token',
            hash('sha256', $token),
            '*'
        ]);

        return ApiResponseHelper::success([
            'token' => $token,
            'message' => 'Login successful'
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan ini mengarah ke file yang benar
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponseHelper::error('No token provided');
        }

        // Hash the token for comparison
        $hashedToken = hash('sha256', $token);

        // Delete the token using raw query
        $deleted = DB::delete('DELETE FROM personal_access_tokens WHERE token = ?', [$hashedToken]);

        if ($deleted) {
            return ApiResponseHelper::success([
                'message' => 'Logged out successfully'
            ]);
        } else {
            return ApiResponseHelper::error('Failed to logout', );
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Hash the password
            $hashedPassword = Hash::make($request->input('password'));

            // Insert admin into database using raw query
            DB::insert('INSERT INTO admins (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [
                $request->input('name'),
                $request->input('email'),
                $hashedPassword
            ]);

            return ApiResponseHelper::created([], 'Admin registered successfully');

        } catch (\Exception $e) {
            return ApiResponseHelper::error('Registration failed: ' . $e->getMessage(), 500);
        }
    }
}
