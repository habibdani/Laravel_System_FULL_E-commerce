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
    public function getListOrder(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Default items per page
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $skip = ($currentPage * $perPage) - $perPage;

            $listOrder = DB::select("
                SELECT
                    b.id bookings_id,
                    b.client_name,
                    b.client_email,
                    DATE_FORMAT(b.created_at, '%e %M %Y - %H:%i') AS created_at,
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
                GROUP BY
                    b.id
                ORDER BY b.id DESC
                LIMIT :skip, :perPage
            ", ['skip' => $skip, 'perPage' => $perPage]);

                // Get total count of records
                $total = DB::table('bookings')
                    ->whereNull('deleted_at')
                    ->count();

                // Create a paginator instance
                $listOrderPaginator = new LengthAwarePaginator(
                    $listOrder,
                    $total,
                    $perPage,
                    $currentPage,
                    ['path' => LengthAwarePaginator::resolveCurrentPath()]
                );
            return ApiResponseHelper::success($listOrderPaginator, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e, 500);
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
}

