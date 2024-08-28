<?php

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $clientType = $request->input('client_type');

        // Retrieve data based on client_type
        $clientTypeData = DB::table('client_type_id')->where('id', $clientType)->first();

        return view('shop-page', compact('clientTypeData'));
    }
}
