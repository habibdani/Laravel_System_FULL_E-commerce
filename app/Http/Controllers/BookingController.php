<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;
use App\Helpers\ApiResponseHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductVariant;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use App\Models\BookingItem;

class BookingController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            // Validasi input dasar
            $validator = Validator::make($request->all(), [
                'client_type_id' => 'required|integer',
                'client_name' => 'required|string|max:255',
                'client_phone_number' => 'required|string|max:20',
                'client_email' => 'required|string|email|max:255',
                'shipping_area_id' => 'required|integer',
                'shipping_district_id' => 'required|integer',
                'shipping_subdistrict_id' => 'required|integer',
                'shipping_id' => 'required|integer',
                'ongkir' => 'required|integer',
                'address' => 'required|string|max:255',
                'code_pos' => 'required|string|max:10',
                'additional_price_percentage' => 'nullable|numeric',
                'commission_percentage' => 'nullable|numeric',
                'booking_items' => 'required|array',
                'booking_items.*.product_variant_id' => 'required|integer',
                'booking_items.*.price' => 'required|numeric',
                'booking_items.*.qty' => 'required|integer',
                'booking_items.*.product_variant_item_id' => [
                    'nullable', // Tambahkan nullable untuk memperbolehkan null
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        // Jika nilai adalah null, lewati validasi
                        if (is_null($value)) {
                            return;
                        }

                        // Ambil indeks dari atribut
                        $index = (int) filter_var($attribute, FILTER_SANITIZE_NUMBER_INT);
                        $productVariantId = $request->input("booking_items.$index.product_variant_id");

                        // Validasi apakah product_variant_item_id sesuai dengan product_variant_id
                        $match = DB::table('product_variant_items')
                            ->where('id', $value)
                            ->where('product_variant_id', $productVariantId)
                            ->exists();

                        if (!$match) {
                            $fail("The selected product_variant_item_id at index $index does not match the product_variant_id.");
                        }
                    },
                ],
                'note' => 'nullable|string',
                'ktp_image' => 'nullable|string',
                'bank_name' => 'nullable|string|max:255',
                'bank_account_number' => 'nullable|string|max:20',
                'bank_account_holder_name' => 'nullable|string|max:255',
            ]);

            $validator->after(function ($validator) use ($request) {
                $shippingSubdistrictId = $request->input('shipping_subdistrict_id');
            
                // Jika shipping_subdistrict_id adalah 0, anggap null dan abaikan validasi
                if ($shippingSubdistrictId == 0) {
                    $request->merge(['shipping_subdistrict_id' => null]);
                    return;
                }
            
                // Lanjutkan validasi jika shipping_subdistrict_id tidak bernilai 0
                $shippingData = DB::table('shipping_subdistricts as ss')
                    ->join('shipping_districts as sd', 'sd.id', '=', 'ss.shipping_district_id')
                    ->whereNull('ss.deleted_at')
                    ->whereNull('sd.deleted_at')
                    ->where('ss.id', $shippingSubdistrictId)
                    ->select('sd.shipping_area_id', 'ss.shipping_district_id')
                    ->first();
            
                if (!$shippingData) {
                    $validator->errors()->add('shipping_subdistrict_id', 'Invalid shipping_subdistrict_id.');
                } else {
                    if ($shippingData->shipping_district_id != $request->input('shipping_district_id')) {
                        $validator->errors()->add('shipping_district_id', 'The selected shipping_district_id does not match the shipping_subdistrict_id.');
                    }
            
                    if ($shippingData->shipping_area_id != $request->input('shipping_area_id')) {
                        $validator->errors()->add('shipping_area_id', 'The selected shipping_area_id does not match the shipping_subdistrict_id.');
                    }
                }
            });
            

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }
            DB::beginTransaction();

            // Insert ke tabel bookings
            $bookingId = DB::table('bookings')->insertGetId([
                'client_type_id' => $request->input('client_type_id'),
                'client_name' => $request->input('client_name'),
                'client_phone_number' => $request->input('client_phone_number'),
                'client_email' => $request->input('client_email'),
                'shipping_area_id' => $request->input('shipping_area_id'),
                'address' => $request->input('address'),
                'code_pos' => $request->input('code_pos'),
                'additional_price_percentage' => $request->input('additional_price_percentage'),
                'commission_percentage' => $request->input('commission_percentage'),
                'created_at' => now(),
            ]);

            // Insert ke tabel booking_shippings
            $bookingShippingId = DB::table('booking_shippings')->insertGetId([
                'booking_id' => $bookingId,
                'shipping_id' => $request->input('shipping_id'),
                'price' => $request->input('ongkir'),
                'shipping_district_id' => $request->input('shipping_district_id'),
                'shipping_subdistrict_id' => $request->input('shipping_subdistrict_id'),
                'created_at' => now(),
            ]);

            // Insert ke tabel booking_dropship_identities (opsional)
            if ($request->input('client_type_id') == 2) {
                $bookingDropshipIdentityId = DB::table('booking_dropship_identities')->insertGetId([
                    'booking_id' => $bookingId,
                    'ktp_image' => $request->input('ktp_image'),
                    'bank_name' => $request->input('bank_name'),
                    'bank_account_number' => $request->input('bank_account_number'),
                    'bank_account_holder_name' => $request->input('bank_account_holder_name'),
                    'created_at' => now(),
                ]);
            }

            // Insert ke tabel booking_items
            foreach ($request->input('booking_items') as $item) {
                DB::table('booking_items')->insert([
                    'product_variant_id' => $item['product_variant_id'],
                    'booking_id' => $bookingId,
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'product_variant_item_id' => $item['product_variant_item_id'],
                    'note' => $item['note'] ?? null, // opsional
                    'created_at' => now(),
                ]);

                // Update stok qty di tabel product_variants
                $productVariantId = $item['product_variant_id'];
                $quantityBooked = $item['qty'];

                // Update stok produk varian setelah booking
                $updated = DB::table('product_variants')
                    ->where('id', $productVariantId)
                    ->decrement('stock', $quantityBooked); // Mengurangi stok dengan jumlah yang dibooking

                if ($updated === 0) {
                    // Jika stoknya tidak bisa dikurangi (misalnya stok tidak cukup)
                    DB::rollBack();
                    return ApiResponseHelper::error('Not enough stock for product variant ' . $productVariantId, 400);
                }
            }

            // Insert ke tabel booking_status_histories
            DB::table('booking_status_histories')->insertGetId([
                'booking_id' => $bookingId,
                'booking_status_id' => 6,
                'created_at' => now(),
            ]);

            // Commit transaksi
            DB::commit();

            return ApiResponseHelper::created(['booking_id' => $bookingId], 'Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function getListOrder(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default items per page
            $search = $request->input('search'); // Mendapatkan input pencarian dari request

            // Query menggunakan Laravel query builder atau Eloquent
            $queryListOrder = DB::table('bookings as b')
                ->join('shipping_areas as sa', 'b.shipping_area_id', '=', 'sa.id')
                ->join('booking_items as bi', 'b.id', '=', 'bi.booking_id')
                ->join('booking_shippings as bs', 'bs.booking_id', '=', 'b.id')
                ->join('shipping_districts as sd', 'sd.id', '=', 'bs.shipping_district_id')
                ->join('shipping_areas as sa2', 'sa2.id', '=', 'sd.shipping_area_id')
                ->join('booking_status_histories as bsh', 'bsh.booking_id', '=', 'b.id')
                ->join(DB::raw('(SELECT MAX(id) AS id FROM booking_status_histories GROUP BY booking_id) as m_bsh'), 'bsh.id', '=', 'm_bsh.id')
                ->join('booking_status as bt', 'bt.id', '=', 'bsh.booking_status_id')
                ->whereNull('b.deleted_at')
                ->whereNull('sa.deleted_at')
                ->whereNull('bi.deleted_at')
                ->whereNull('bs.deleted_at')
                ->whereNull('sd.deleted_at')
                ->whereNull('sa2.deleted_at')
                ->groupBy('b.id')
                ->select(
                    'b.id as bookings_id',
                    'b.client_name',
                    'b.client_email',
                    DB::raw("DATE_FORMAT(b.created_at, '%e %M %Y - %H:%i') as created_at"),
                    DB::raw("CONCAT(b.address, ', ', sa.name, ', ', b.code_pos) as ship_to"),
                    DB::raw("CASE WHEN sa.id = sa2.id THEN 'TRUE' ELSE 'FALSE' END as area_match"),
                    DB::raw("DATE_FORMAT(bsh.created_at, '%e %M %Y - %H:%i') as last_update"),
                    'bt.name as status_name',
                    'bt.color_status',
                    DB::raw('SUM(bi.price) as amount')
                )
                ->orderBy('bsh.created_at', 'DESC');

            // Jika ada pencarian berdasarkan client_name
            if (!empty($search)) {
                $queryListOrder->where('b.client_name', 'LIKE', "%{$search}%");
            }

            // Pagination
            $listOrder = $queryListOrder->paginate($perPage);

            return ApiResponseHelper::success([
                'data' => $listOrder->items(),
                'currentPage' => $listOrder->currentPage(),
                'total' => $listOrder->total(),
                'pagination' => [
                    'current_page' => $listOrder->currentPage(),
                    'last_page' => $listOrder->lastPage(),
                    'per_page' => $listOrder->perPage(),
                    'total' => $listOrder->total(),
                    'next_page_url' => $listOrder->nextPageUrl(),
                    'prev_page_url' => $listOrder->previousPageUrl(),
                ]
            ], 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e->getMessage(), 500);
        }
    }

    public function getDetilsOrder(Request $request)
    {
        try {
            $id = $request->query('id');

            // Validasi input
            if (!$id || !is_numeric($id)) {
                return ApiResponseHelper::error('ID is required and must be a valid integer.', 400);
            }
            $listOrder = DB::select("
                SELECT
                b.id bookings_id,
                DATE_FORMAT(b.created_at, '%e %M %Y - %H:%i') AS created_at,
                bt.`name` status_name,
                bt.color_status,

                b.client_name,
                b.address,
                sa.`name` city,
                b.code_pos,
                b.client_phone_number,
                b.client_email,

                CASE
                    WHEN sa.id = sa2.id THEN 'TRUE'
                    ELSE 'FALSE'
                END AS area_match,
                bi.product_variant_id
                FROM bookings b
                JOIN shipping_areas sa ON b.shipping_area_id = sa.id
                JOIN booking_items bi ON b.id = bi.booking_id
                JOIN booking_shippings bs ON bs.booking_id = b.id
                JOIN shipping_districts sd ON sd.id = bs.shipping_district_id
                    JOIN shipping_areas sa2 ON sa2.id = sd.shipping_area_id
                JOIN booking_status_histories bsh ON bsh.booking_id = b.id
                JOIN (SELECT MAX(id) id FROM booking_status_histories GROUP BY booking_id) m_bsh ON bsh.id = m_bsh.id
                JOIN booking_status bt ON bt.id = bsh.booking_status_id
                WHERE
                    b.id = :id
                    AND b.deleted_at IS NULL
                    AND sa.deleted_at IS NULL
                    AND bi.deleted_at IS NULL
                    AND bs.deleted_at IS NULL
                    AND sd.deleted_at IS NULL
                    AND sa2.deleted_at IS NULL
                GROUP BY
                    b.id
                ORDER BY b.id DESC
                ", ['id' => $id]);

                $productDetails = DB::select("
                SELECT
                    bi.booking_id,
                    bi.id booking_item_id,
                    pv.id product_variant_id,
                    CONCAT(p.title,' - ',pv.`name`) product_name,
                    CONCAT(vit.`name`,': ',pvi.`name`) variant_detail,
                    bi.qty,
                    bi.price
                FROM
                    booking_items bi
                    JOIN product_variants pv ON pv.id = bi.product_variant_id
                    JOIN products p ON p.id = pv.product_id
                    JOIN product_variant_items pvi ON pvi.product_variant_id = pv.id AND bi.product_variant_item_id = pvi.id
                    JOIN variant_item_types vit ON pvi.variant_item_type_id = vit.id
                where
                    bi.booking_id = :id
                    AND bi.deleted_at IS NULL
                    AND pv.deleted_at IS NULL
                    AND p.deleted_at IS NULL
                    AND pvi.deleted_at IS NULL
                    AND vit.deleted_at IS NULL
                ", ['id' => $id]);

                $data = [
                    'order' => $listOrder,
                    'products' => $productDetails
                ];

            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e, 500);
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|integer',
            'products'   => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity'   => 'required|integer|min:1',
        ]);

        $bookingId = $validatedData['booking_id'];
        $productData = collect($validatedData['products']);

        // Ambil semua booking items dari database
        $existingItems = BookingItem::where('booking_id', $bookingId)->get();

        // Loop untuk update kuantitas
        foreach ($productData as $product) {
            BookingItem::updateOrCreate(
                ['id' => $product['product_id'], 'booking_id' => $bookingId], // Kunci unik
                ['qty' => $product['quantity']]
            );
        }

        // Soft delete items yang tidak ada di request
        $productIds = $productData->pluck('product_id')->toArray();
        BookingItem::where('booking_id', $bookingId)
            ->whereNotIn('id', $productIds)
            ->update(['deleted_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Booking items updated successfully.']);
    }

    public function updateStatusOrder(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'status_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Mendapatkan nilai dari request
            $bookingId = $request->input('id');
            $statusId = $request->input('status_id');

            // Query untuk memasukkan data ke tabel booking_status_histories
            $queryUpdateOrder = "
                INSERT INTO booking_status_histories (booking_id, booking_status_id, created_at, updated_at)
                VALUES (?, ?, NOW(), NOW())
            ";

            // Eksekusi query
            DB::statement($queryUpdateOrder, [$bookingId, $statusId]);

            $getStatus = DB::select("
                SELECT *
                FROM booking_status
                WHERE booking_status.id = ".$statusId
            );

            $results = DB::select("
                SELECT 
                    b.id AS booking_id,
                    b.client_name,
                    b.client_email,
                    b.client_type_id,
                    b.client_phone_number,
                    b.address,
                    b.code_pos,
                    bsh.price as ongkir,
                    b.additional_price_percentage,
                    b.commission_percentage,
                    bi.product_variant_item_id,
                    pvi.name AS product_variant_name,
                    bi.price AS product_price,
                    bi.qty AS product_qty,
                    (bi.price * bi.qty) AS product_subtotal,
                    SUM(bi.price * bi.qty) AS total_price_booking,
                    bsh.shipping_id,
                    bs.name AS shipping_name,
                    bs.color_status AS shipping_status_color
                FROM 
                    bookings b
                LEFT JOIN 
                    booking_items bi ON b.id = bi.booking_id
                LEFT JOIN 
                    product_variant_items pvi ON bi.product_variant_item_id = pvi.id
                LEFT JOIN 
                    booking_shippings bsh ON b.id = bsh.booking_id
                LEFT JOIN 
                    booking_status bs ON bsh.shipping_id = bs.id
                WHERE b.id = ".$bookingId."
                GROUP BY 
                    b.id, bi.product_variant_item_id;

            ");

            $resultItems = DB::select("
                SELECT
                    bi.id AS booking_item_id,
                    bi.booking_id,
                    bi.product_variant_id,
                    pv.name AS product_variant_name,
                    bi.price AS product_price,
                    bi.qty AS product_qty,
                    (bi.price * bi.qty) AS subtotal
                FROM
                    booking_items AS bi
                LEFT JOIN
                    product_variants AS pv ON bi.product_variant_id = pv.id
                WHERE
                    bi.booking_id = ".$bookingId."
                    AND bi.deleted_at IS NULL;

            ");
            $commission = DB::select("
                SELECT *
                FROM client_types
                WHERE client_types.id = ".$results[0]->client_type_id."

            ");

            // dd($results);

            // $data = response()->json($results);

            try {
                $htmlContent = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Laporan Pembelian</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f9f9f9;
                            color: #333;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            border-radius: 8px;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                        }
                        .header {
                            background-color: #4CAF50;
                            color: white;
                            padding: 20px;
                            text-align: center;
                            border-radius: 8px 8px 0 0;
                        }
                        .status {
                            background-color: #f4f4f4; /* Warna latar lebih netral */
                            color: #333; /* Warna teks lebih kontras */
                            padding: 10px; /* Menambahkan ruang di dalam elemen */
                            text-align: center; /* Teks berada di tengah */
                            border-radius: 8px; /* Menyamakan radius sudut dengan elemen lain */
                            margin: 10px 20px; /* Memberikan margin agar terlihat simetris */
                            font-weight: bold; /* Membuat teks lebih menonjol */
                            border: 1px solid #ddd; /* Memberikan sedikit garis tepi */
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk efek */
                        }
                        .content {
                            padding: 20px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            text-align: left;
                            padding: 10px;
                            border: 1px solid #ddd;
                        }
                        th {
                            background-color: #f4f4f4;
                        }
                        .footer {
                            text-align: center;
                            padding: 10px;
                            font-size: 14px;
                            color: #555;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='flex items-center'>
                            <img src='{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}' alt='Logo' class='h-8'>
                        </div>
                        <div class='header'>
                            <h1>{$getStatus[0]->name}</h1>
                        </div>
                        <div class='content'>
                            <p>Halo, <strong>{$results[0]->client_name}</strong>!</p>
                            <p>Berikut adalah detail pembelian Anda:</p>
                            
                            <h3>Informasi Pembeli</h3>
                            <table>
                                <tr><th>Nama</th><td>{$results[0]->client_name}</td></tr>
                                <tr><th>Email</th><td>{$results[0]->client_email}</td></tr>
                                <tr><th>Telepon</th><td>{$results[0]->client_phone_number}</td></tr>
                                <tr><th>Alamat</th><td>{$results[0]->address}</td></tr>
                                <tr><th>Kode Pos</th><td>{$results[0]->code_pos}</td></tr>
                                <tr><th>Persentase Komisi</th><td>{$results[0]->client_type_id} %</td></tr>
                            </table>
    
                            <h3>Detail Pesanan</h3>
                            <table>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Komisi</th>
                                </tr>";
                foreach ($resultItems as $item) {
                    $subtotal = $item->product_price * $item->product_qty;
                    $htmlContent .= "
                                <tr>
                                    <td>{$item->product_variant_name}</td>
                                    <td>Rp " . number_format($item->product_price, 0, ',', '.') . "</td>
                                    <td>{$item->product_qty}</td>
                                    <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                                    <td>Rp " . number_format($subtotal * ($commission[0]->price_persentage / 100), 0, ',', '.') . "</td>
                                </tr>";
                }
    
                $htmlContent .= "
                                <tr><th colspan='3' style='text-align: right;'>Total</th><td>Rp " . number_format($results[0]->total_price_booking, 0, ',', '.') . "</td></tr>
                            </table>
    
                            <h3>Informasi Pengiriman</h3>
                            <table>
                                <tr><th>Ongkir</th><td>Rp {$results[0]->ongkir}</td></tr>                       
                            </table>

    
                            <p>Terima kasih telah berbelanja bersama kami!</p>
                        </div>
                        <div class='footer'>
                            &copy; 2024 PT. Andal Prima. Semua Hak Dilindungi.
                        </div>
                    </div>
                </body>
                </html>";
            } catch (\Exception $e) {
                // return response()->json(['error' => 'Gagal memproses template HTML.', 'details' => $e->getMessage()], 500);
            }

            
            // <h3>Informasi Rekening</h3>
            // <table>
            //     <tr><th>Nama Rekening</th><td>{$validated['namaRekening']}</td></tr>
            //     <tr><th>Nomor Rekening</th><td>{$validated['nomorRekening']}</td></tr>
            // </table>
    
            // Kirim email dengan konten HTML
            try {
                Mail::html($htmlContent, function ($message) use ($results, $getStatus) {
                    $message->to($results[0]->client_email)
                            ->subject("Update Informasi Pesanan Anda - " . $getStatus[0]->name);
                });
    
                // return response()->json(['message' => 'Email berhasil dikirim.'], 200);
            } catch (\Exception $e) {
                // return response()->json(['error' => 'Gagal mengirim email.', 'details' => $e->getMessage()], 500);
            }

            return ApiResponseHelper::success(null, 'Status order berhasil diperbarui');
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e, 500);
        }
    }
}

