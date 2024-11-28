<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        // Decode JSON menjadi array
        $data = json_decode($validated['data'], true);

        if (!$data) {
            return response()->json(['error' => 'Data payload tidak valid.'], 400);
        }

        // Template HTML untuk email
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
                    <p>Halo, <strong>{$data['client_name']}</strong>!</p>
                    <p>Berikut adalah detail pembelian Anda:</p>
                    
                    <h3>Informasi Pembeli</h3>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td>{$data['client_name']}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{$data['client_email']}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{$data['client_phone_number']}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{$data['address']}</td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td>{$data['code_pos']}</td>
                        </tr>
                        <tr>
                            <th>Nomor WhatsApp</th>
                            <td>{$validated['nomorwa']}</td>
                        </tr>
                        <tr>
                            <th>Link WhatsApp</th>
                            <td><a href='{$validated['linkwa']}' target='_blank'>Klik di sini</a></td>
                        </tr>
                    </table>

                    <h3>Detail Pesanan</h3>
                    <table>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>";

        $totalPrice = 0;

        foreach ($data['booking_items'] as $item) {
            $subtotal = $item['price'] * $item['qty'];
            $totalPrice += $subtotal;
            $htmlContent .= "
                        <tr>
                            <td>Varian ID: {$item['product_variant_id']}</td>
                            <td>Rp " . number_format($item['price'], 0, ',', '.') . "</td>
                            <td>{$item['qty']}</td>
                            <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                        </tr>";
        }

        $htmlContent .= "
                        <tr>
                            <th colspan='3' style='text-align: right;'>Total</th>
                            <td>Rp " . number_format($totalPrice, 0, ',', '.') . "</td>
                        </tr>
                    </table>

                    <h3>Informasi Pengiriman</h3>
                    <table>
                        <tr>
                            <th>Ongkir</th>
                            <td>Rp " . number_format($data['ongkir'], 0, ',', '.') . "</td>
                        </tr>
                    </table>

                    <h3>Informasi Rekening</h3>
                    <table>
                        <tr>
                            <th>Nama Rekening</th>
                            <td>{$validated['namaRekening']}</td>
                        </tr>
                        <tr>
                            <th>Nomor Rekening</th>
                            <td>{$validated['nomorRekening']}</td>
                        </tr>
                    </table>

                    <p>Terima kasih telah berbelanja bersama kami!</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " PT. Andal Prima. Semua Hak Dilindungi.
                </div>
            </div>
        </body>
        </html>
        ";

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

}
