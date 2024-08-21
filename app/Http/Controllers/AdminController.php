<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponseHelper;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin yang sudah login.
     */
    public function dashboard(Request $request)
    {
        $admin = $request->user(); // Mengambil data admin yang sedang login

        return ApiResponseHelper::success([
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
            'message' => 'Welcome to the admin dashboard'
        ]);
    }
}
