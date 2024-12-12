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

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'data' => 'required|string', // JSON diterima sebagai string
            'nomorwa' => 'required|string',
            'linkwa' => 'required|url',
            'namaRekening' => 'required|string',
            'nomorRekening' => 'required|string',
        ]);

        // Validasi data tambahan lainnya
        if (empty($validated['to']) || empty($validated['subject']) || empty($validated['data'])) {
            return response()->json(['error' => 'Data yang diperlukan tidak lengkap. Pastikan semua data sudah diisi dengan benar.'], 400);
        }

        // Decode JSON menjadi array dengan error handling
        try {
            $data = json_decode($validated['data'], true);

            if (!$data) {
                throw new \Exception('Data payload tidak valid atau format JSON salah.');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membaca data JSON.', 'details' => $e->getMessage()], 400);
        }

        // Pastikan payload memiliki struktur yang benar
        if (!isset($data['payload']['client_name']) || !isset($data['payload']['client_email']) || !isset($data['payload']['client_phone_number']) || !isset($data['payload']['address'])) {
            return response()->json(['error' => 'Data JSON tidak lengkap. Pastikan semua informasi yang diperlukan ada dalam payload.'], 400);
        }

        // Proses generate HTML template dengan error handling
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
                    <div class='header'>
                        <h1>Laporan Pembelian</h1>
                    </div>
                    <div class='content'>
                        <p>Halo, <strong>{$data['payload']['client_name']}</strong>!</p>
                        <p>Berikut adalah detail pembelian Anda:</p>
                        
                        <h3>Informasi Pembeli</h3>
                        <table>
                            <tr><th>Nama</th><td>{$data['payload']['client_name']}</td></tr>
                            <tr><th>Email</th><td>{$data['payload']['client_email']}</td></tr>
                            <tr><th>Telepon</th><td>{$data['payload']['client_phone_number']}</td></tr>
                            <tr><th>Alamat</th><td>{$data['payload']['address']}</td></tr>
                            <tr><th>Kode Pos</th><td>{$data['payload']['code_pos']}</td></tr>
                            <tr><th>Nomor WhatsApp</th><td>{$validated['nomorwa']}</td></tr>
                            <tr><th>Link WhatsApp</th><td><a href='{$validated['linkwa']}' target='_blank'>Klik di sini</a></td></tr>
                        </table>

                        <h3>Detail Pesanan</h3>
                        <table>
                            <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>";
                            
            foreach ($data['payload']['booking_items'] as $item) {
                $subtotal = $item['price'] * $item['qty'];
                $htmlContent .= "
                            <tr>
                                <td>{$item['product_variant_name']}</td>
                                <td>Rp " . number_format($item['price'], 0, ',', '.') . "</td>
                                <td>{$item['qty']}</td>
                                <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                            </tr>";
            }

            $htmlContent .= "
                            <tr><th colspan='3' style='text-align: right;'>Total</th><td>Rp " . number_format($data['payload']['total_price_booking'], 0, ',', '.') . "</td></tr>
                        </table>

                        <h3>Informasi Pengiriman</h3>
                        <table>
                            <tr><th>Ongkir</th><td>Rp {$data['payload']['ongkir']}</td></tr>                       
                        </table>

                        <h3>Informasi Rekening</h3>
                        <table>
                            <tr><th>Nama Rekening</th><td>{$validated['namaRekening']}</td></tr>
                            <tr><th>Nomor Rekening</th><td>{$validated['nomorRekening']}</td></tr>
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
            return response()->json(['error' => 'Gagal memproses template HTML.', 'details' => $e->getMessage()], 500);
        }

        // Kirim email dengan konten HTML
        try {
            Mail::html($htmlContent, function ($message) use ($validated) {
                $message->to($validated['to'])
                        ->subject($validated['subject']);
            });

            return response()->json(['message' => 'Email berhasil dikirim.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengirim email.', 'details' => $e->getMessage()], 500);
        }
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

