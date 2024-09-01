<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; // Tambahkan ini

class ViewPageController extends Controller
{
    public function maps(Request $request)
    {
        // Ambil input client_type_id dari request
        $clientTypeId = $request->input('client_type_id');

        // Ambil data berdasarkan client_type_id
        $clientTypeData = DB::table('client_types')->where('id', $clientTypeId)->first();

        // Tampilkan view maps-page dengan data yang didapat
        return view('maps-page', compact('clientTypeData'));
    }

    public function shop(Request $request)
    {
        $ongkir = $request->input('ongkir');
        $jarak = $request->input('jarak');
        $waktu = $request->input('waktu');
        $locate = json_decode($request->input('locate'), true); // Decode JSON to associative array

        // Mengambil data dari API

        return view('shop-page', compact('ongkir', 'jarak', 'waktu', 'locate'));
    }
}
