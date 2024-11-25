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
                'price' => $request->input('price'),
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
            }

            // Insert ke tabel booking_status_histories
            DB::table('booking_status_histories')->insertGetId([
                'booking_id' => $bookingId,
                'booking_status_id' => 2,
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

            return ApiResponseHelper::success(null, 'Status order berhasil diperbarui');
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e, 500);
        }
    }
}

