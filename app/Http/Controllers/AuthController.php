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
        $hashedToken = hash('sha256', $token);

        // Check if a token already exists for this `tokenable_id`
        $existingToken = DB::select('SELECT * FROM personal_access_tokens WHERE tokenable_id = ? AND tokenable_type = ?', [
            $admin[0]->id,
            'App\Models\Admin'
        ]);

        if (!empty($existingToken)) {
            // If the tokenable_id exists, update the token
            DB::update('UPDATE personal_access_tokens SET token = ?, updated_at = NOW() WHERE tokenable_id = ? AND tokenable_type = ?', [
                $hashedToken,
                $admin[0]->id,
                'App\Models\Admin'
            ]);
        } else {
            // If the tokenable_id doesn't exist, insert a new token
            DB::insert('INSERT INTO personal_access_tokens (tokenable_id, tokenable_type, name, token, abilities, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())', [
                $admin[0]->id,
                'App\Models\Admin',
                'admin-token',
                $hashedToken,
                '*'
            ]);
        }

        return ApiResponseHelper::success([
            'token' => $token,
            'admin_id' => $admin[0]->id
        ], 'Login successful');

        // return redirect()->route('dashboard')->with([
        //     'token' => $token,
        //     'message' => 'Login successful'
        // ]);

    }

    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan ini mengarah ke file yang benar
    }

    public function logout(Request $request)
    {
        // Get the bearer token from the request
        $token = $request->bearerToken();

        // Check if a token is provided
        if (!$token) {
            return ApiResponseHelper::error('No token provided', 400);
        }

        // Hash the token for comparison
        $hashedToken = hash('sha256', $token);

        // Delete the token using raw query
        $deleted = DB::delete('DELETE FROM personal_access_tokens WHERE token = ?', [$hashedToken]);

        // Check if the token was successfully deleted
        if ($deleted) {
            return ApiResponseHelper::success([
                'message' => 'Logged out successfully'
            ], 200);
        } else {
            // If token not found or failed to delete, return an error
            return ApiResponseHelper::error('Failed to logout or token not found', 400);
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
