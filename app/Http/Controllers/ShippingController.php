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
                ORDER BY id DESC
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
                    sd.price,
                    CONCAT(sd.`name`, ', ', REPLACE(sa.`name`, 'Kab ', 'Kabupaten ')) as city,
                    sa.id as shipping_area_id,
                    CONCAT(sd.`name`, ' - ', sa.`name`) as alamat,
					COALESCE(ss.id, 0) as subdistrict_id
                FROM
                    shipping_areas sa 
                    JOIN shipping_districts sd ON sd.shipping_area_id = sa.id
                    LEFT JOIN shipping_subdistricts ss ON sd.id = ss.shipping_district_id
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
