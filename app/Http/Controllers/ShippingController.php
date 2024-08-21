<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Helpers\ApiResponseHelper;

class ShippingController extends Controller
{
    public function getShippings(): JsonResponse
    {
        try {
            $results = DB::select("
                SELECT
                    s.id,
                    s.`name` as type_pembelian,
                    s.price_discount_percentage
                FROM
                    `shippings` s
                WHERE
                    s.deleted_at IS NULL
            ");

            $data = response()->json($results);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function getShippingDistricts(): JsonResponse
    {
        try {
            $results = DB::select("
                SELECT
                    sd.id as district_id,
                    sa.id as shipping_area_id,
                    CONCAT(sd.`name`, ' - ', sd.`name`) as alamat
                FROM
                    shipping_districts sd
                    JOIN shipping_areas sa ON sd.shipping_area_id = sa.id
                WHERE
                    sd.deleted_at IS NULL
                    AND sa.deleted_at IS NULL
                ORDER BY
                    alamat ASC
            ");

            $data = response()->json($results);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }
}
