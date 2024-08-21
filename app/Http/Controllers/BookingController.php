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

class BookingController extends Controller
{
    public function getListOrder(Request $request)
    {
        try {
            $listOrder = DB::select("
                SELECT
                    b.id bookings_id,
                    b.client_name,
                    b.client_email,
                    b.created_at,
                    CONCAT(b.address,', ',sa.`name`,', ',b.code_pos) ship_to,
                    CASE
                        WHEN sa.id = sa2.id THEN 'TRUE'
                        ELSE 'FALSE'
                    END AS area_match,
                    bsh.created_at last_update,
                    bt.`name` status_name,
                    SUM(b.ongkir + bi.price) amount
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
                    b.deleted_at IS NULL
                GROUP BY b.id
                ORDER BY b.id DESC
            ");

            $data = response()->json($listOrder);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function getDetilsOrder(Request $request, $id)
    {
        try {
            $listOrder = DB::select("
                SELECT
                    b.id bookings_id,
                    b.client_name,
                    b.client_email,
                    b.created_at,
                    CONCAT(b.address,', ',sa.`name`,', ',b.code_pos) ship_to,
                    CASE
                        WHEN sa.id = sa2.id THEN 'TRUE'
                        ELSE 'FALSE'
                    END AS area_match,
                    bsh.created_at last_update,
                    bt.`name` status_name,
                    SUM(b.ongkir + bi.price) amount
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
                    b.deleted_at IS NULL
                GROUP BY b.id
                ORDER BY b.id DESC
            ");

            $data = response()->json($listOrder);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }
}

