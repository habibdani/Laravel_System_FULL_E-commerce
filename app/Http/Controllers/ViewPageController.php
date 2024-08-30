<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Ambil input client_type_id dari request
        // $clientTypeId = $request->input('client_type_id');

        // Ambil data berdasarkan client_type_id
        // $clientTypeData = DB::table('client_types')->where('id', $clientTypeId)->first();

        // Tampilkan view maps-page dengan data yang didapat
        return view('shop-page'); //compact('clientTypeData'));
    }
}
