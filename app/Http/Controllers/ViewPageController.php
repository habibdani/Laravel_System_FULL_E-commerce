<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; // Tambahkan ini

class ViewPageController extends Controller
{
    public function maps(Request $request)
    {
        // dd($request->input('client_type_id'));

        // Ambil input client_type_id dari request
        $clientTypeId = $request->input('client_type_id');

        // Ambil data berdasarkan client_type_id
        $clientTypeData = DB::table('client_types')->where('id', $clientTypeId)->first();

        // Tampilkan view maps-page dengan data yang didapat
        return view('maps-page', compact('clientTypeData','clientTypeId'));
    }

    public function shop(Request $request)
    {
        $ongkir = $request->input('ongkir');
        $jarak = $request->input('jarak');
        $waktu = $request->input('waktu');
        $locate = json_decode($request->input('locate'), true); // Decode JSON to associative array

        return view('shop-page', compact('ongkir', 'jarak', 'waktu', 'locate'));
    }

    public function product(Request $request)
    {
        $productVariantId = $request->query('product_variant_id');
        $productTypeId = $request->query('product_type_id');

        $productDetails = DB::table('product_variants')
            ->where('id', $productVariantId)
            ->first();

        $productType = DB::table('product_types')
            ->where('id', $productTypeId)
            ->first();

        return view('product-page', compact('productDetails', 'productVariantId','productTypeId'));
    }

    public function dashboard(Request $request)
    {
        return view('dashboard-page');
    }

    public function dashboardProduct(Request $request)
    {
        return view('product-dashboard-page');
    }
    public function dashboardProductAdd(Request $request)
    {
        return view('add-Product-page');
    }
    public function dashboardProductEdit($productVariantId)
    {
        return view('edit-Product-page', compact('productVariantId'));
    }
    public function dashboardOrders(Request $request)
    {
        return view('orders-page');
    }
    public function dashboardOrdersDetail($booking_id)
    {
        // Debug to check if booking_id is received
        // dd($booking_id);

        return view('orders-detail-page');
    }
    public function dashboardSetting()
    {
        return view('setting-page');
    }
    public function dashboardSettingbannerbesar()
    {
        return view('setting-banner-besar');
    }
    public function dashboardSettingbannerkecil()
    {
        return view('setting-banner-kecil');
    }
    public function dashboardSettingrekening()
    {
        return view('setting-rekening');
    }
    public function dashboardSettingwa()
    {

        return view('setting-wa');
    }
    public function productbyid(Request $request)
    {
        $productId = $request->query('product_id');

        return view('productbyid-page', compact('productId'));
    }
}
