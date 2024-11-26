<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Kirim email menggunakan Mail facade
        try {
            Mail::raw($validated['body'], function ($message) use ($validated) {
                $message->to($validated['to'])
                        ->subject($validated['subject']);
            });

            return response()->json(['message' => 'Email berhasil dikirim.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengirim email.', 'details' => $e->getMessage()], 500);
        }
    }
}
