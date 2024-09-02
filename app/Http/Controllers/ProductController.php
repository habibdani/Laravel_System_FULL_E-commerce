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

class ProductController extends Controller
{
    public function listproduct(Request $request)
    {
        try {
            $results = DB::select("
                SELECT
                    p.id product_id,
                    p.title product_name,
                    p.product_type_id,
                    pt.name type_name,
                    pv.id product_variant_id,
                    CASE WHEN pv.po_status = 1 THEN 'Preorder' ELSE NULL END AS preorder,
                    CONCAT(pt.name, ' ', pv.name) full_name_product,
                    pv.name variant_name,
                    pv.price variant_price,
                    SUBSTRING_INDEX(pv.image, '/storage/', -1) variant_image
                FROM
                    products p
                JOIN product_types pt ON p.product_type_id = pt.id
                JOIN product_variants pv ON p.id = pv.product_id
                WHERE p.deleted_at IS NULL
                AND pt.deleted_at IS NULL
                AND pv.deleted_at IS NULL
            ");

            $data = response()->json($results);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function productdetails(Request $request)
    {
        // Ambil parameter 'id' dari query string
        $id = $request->query('id');

        // Validasi input
        if (!$id || !is_numeric($id)) {
            return ApiResponseHelper::error('ID is required and must be a valid integer.', 400);
        }

        try {
            $product = DB::select("
                SELECT
                    pv.id product_variant_id,
                    CONCAT(pt.`name`,' ',pv.`name`) full_name_product,
                    pv.price variant_price,
                    MIN(pv.price) AS min_variant_price,
                    MAX(pv.price) AS max_variant_price,
                    CONCAT('" . url('storage/images') . "/', pv.image) AS variant_image,
                    CASE
                        WHEN MIN(pv.price) = MAX(pv.price)
                            THEN CONCAT('Rp ', FORMAT(pv.price, 0))
                        ELSE CONCAT('Rp ', FORMAT(MIN(pv.price), 0), ' - Rp ', FORMAT(MAX(pv.price), 0))
                    END AS price_display
                FROM
                    products p
                JOIN product_types pt ON p.product_type_id = pt.id
                JOIN product_variants pv ON p.id = pv.product_id
                LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                WHERE
                    pv.id = :id
                GROUP BY pv.id, pt.`name`, pv.`name`, pv.price, pv.image
            ", ['id' => $id]);

            $varianttype = DB::select("
                SELECT
                    pv.id product_variant_id,
                    pvi.id variant_item_id,
                    pvi.`name` variant_item_name,
                    vit.id variant_item_type_id,
                    vit.`name` variant_item_type_name
                FROM
                    product_variants pv
                    LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                    LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                WHERE
                    pv.id = :id
                    AND pvi.deleted_at IS NULL
            ", ['id' => $id]);

            $thicknesstype = DB::select("
                SELECT
                    id,
                    CONCAT(thick,'mm') thick
                FROM
                    thickness_types
                WHERE
                    product_variant_id = :id
                    AND deleted_at IS NULL
            ", ['id' => $id]);

            if (empty($product)) {
                return ApiResponseHelper::error('Product variant not found.', 404);
            }

            $response = [
                'product' => $product[0], // Ambil data produk (hanya satu hasil)
                'details' => $varianttype,
                'ketebalan' => $thicknesstype
            ];

            return ApiResponseHelper::success($response, 'Data retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Error in productdetails: ' . $e->getMessage());

            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function getListProductType(Request $request)
    {
        try {
            $listproducttype = DB::select("
            SELECT
                id,
                `name`
            FROM
                product_types
            WHERE deleted_at IS NULL");

            $data = response()->json($listproducttype);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function createProductType(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type_name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Insert produk_type
            $productTypeId = DB::table('product_types')->insertGetId([
                'name' => $request->input('type_name'),
                'created_at' => now(),
            ]);

            return ApiResponseHelper::created(['product_type_id' => $productTypeId], 'Product type created successfully');

        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function getListVariantType(Request $request)
    {
        try {
            $listvarianttype = DB::select("
            SELECT
                id,
                `name`
            FROM
                variant_item_types
            WHERE deleted_at IS NULL");

            $data = response()->json($listvarianttype);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function createVariantType(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'varaint_type_name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Insert produk_type
            $variantItemTypeId = DB::table('variant_item_types')->insertGetId([
                'name' => $request->input('varaint_type_name'),
                'created_at' => now(),
            ]);

            return ApiResponseHelper::created(['variant_item_type_id' => $variantItemTypeId], 'variant item type created successfully');

        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function insertProduct(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'admin_id' => 'required|integer|exists:admins,id',
                'product_type_id' => 'required|integer|exists:product_types,id',
                'product_variant' => 'required|array',
                'product_variant.*.product_variant_name' => 'required|string|max:255',
                'product_variant.*.price' => 'required|numeric|min:0',
                'product_variant.*.image_url' => 'required|string|max:255', // Validasi URL gambar
                'product_variant.*.po_status' => 'required|boolean',
                'product_variant.*.descriptions' => 'required|string|max:255',
                'product_variant.*.product_variant_item' => 'required|array',
                'product_variant.*.product_variant_item.*.product_variant_item_name' => 'required|string|max:255',
                'product_variant.*.product_variant_item.*.variant_item_type_id' => 'required|integer|exists:variant_item_types,id',
                'product_variant.*.product_variant_item.*.price_variant' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Ambil admin_id dari user yang sedang login
            // $adminId = Auth::id();
            $adminId = 1;

            // Memulai transaksi database
            DB::beginTransaction();

            // Insert produk
            $productId = DB::table('products')->insertGetId([
                'title' => $request->input('product_name'),
                'created_by' => $adminId, // Menggunakan admin_id dari token
                'product_type_id' => $request->input('product_type_id'),
                'created_at' => now(),
            ]);

            // Insert product variants
            foreach ($request->input('product_variant') as $variant) {
                $productVariantId = DB::table('product_variants')->insertGetId([
                    'product_id' => $productId,
                    'name' => $variant['product_variant_name'],
                    'price' => $variant['price'],
                    'image' => $variant['image_url'], // Gunakan URL gambar yang diupload
                    'po_status' => $variant['po_status'],
                    'descriptions' => $variant['descriptions'],
                    'created_at' => now(),
                ]);

                // Insert product variant items
                foreach ($variant['product_variant_item'] as $item) {
                    DB::table('product_variant_items')->insert([
                        'product_variant_id' => $productVariantId,
                        'name' => $item['product_variant_item_name'],
                        'variant_item_type_id' => $item['variant_item_type_id'],
                        'add_price' => $item['price_variant'],
                        'created_at' => now(),
                    ]);
                }
            }

            // Commit transaksi database
            DB::commit();

            return ApiResponseHelper::created(['product_id' => $productId], 'Product created successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            Log::error('Error in insertProduct: ' . $e->getMessage());

            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'product_name' => 'sometimes|required|string|max:255',
                'product_variant' => 'sometimes|required|array',
                'product_variant.*.id' => 'required|integer|exists:product_variants,id',
                'product_variant.*.product_variant_name' => 'sometimes|required|string|max:255',
                'product_variant.*.price' => 'sometimes|required|numeric|min:0',
                'product_variant.*.image_url' => 'sometimes|required|string|max:255',
                'product_variant.*.po_status' => 'sometimes|required|boolean',
                'product_variant.*.descriptions' => 'sometimes|required|string|max:255',
                'product_variant.*.product_variant_item' => 'sometimes|required|array',
                'product_variant.*.product_variant_item.*.id' => 'required|integer|exists:product_variant_items,id',
                'product_variant.*.product_variant_item.*.product_variant_item_name' => 'sometimes|required|string|max:255',
                'product_variant.*.product_variant_item.*.price_variant' => 'sometimes|required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Memulai transaksi database
            DB::beginTransaction();

            // Update produk
            if ($request->has('product_name')) {
                DB::table('products')
                    ->where('id', $id)
                    ->update([
                        'title' => $request->input('product_name'),
                        'updated_at' => now(),
                    ]);
            }

            // Update product variants
            if ($request->has('product_variant')) {
                foreach ($request->input('product_variant') as $variant) {
                    DB::table('product_variants')
                        ->where('id', $variant['id'])
                        ->update([
                            'name' => $variant['product_variant_name'] ?? DB::raw('name'),
                            'price' => $variant['price'] ?? DB::raw('price'),
                            'image' => $variant['image_url'] ?? DB::raw('image'),
                            'po_status' => $variant['po_status'] ?? DB::raw('po_status'),
                            'descriptions' => $variant['descriptions'] ?? DB::raw('descriptions'),
                            'updated_at' => now(),
                        ]);

                    // Update product variant items
                    if (isset($variant['product_variant_item'])) {
                        foreach ($variant['product_variant_item'] as $item) {
                            DB::table('product_variant_items')
                                ->where('id', $item['id'])
                                ->update([
                                    'name' => $item['product_variant_item_name'] ?? DB::raw('name'),
                                    'add_price' => $item['price_variant'] ?? DB::raw('add_price'),
                                    'updated_at' => now(),
                                ]);
                        }
                    }
                }
            }

            // Commit transaksi database
            DB::commit();

            return ApiResponseHelper::success([], 'Product updated successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            Log::error('Error in updateProduct: ' . $e->getMessage());

            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function deleteProduct($id)
    {
        try {
            // Memulai transaksi database
            DB::beginTransaction();

            // Hapus item varian produk terlebih dahulu
            DB::table('product_variant_items')
                ->whereIn('product_variant_id', function ($query) use ($id) {
                    $query->select('id')
                        ->from('product_variants')
                        ->where('product_id', $id);
                })
                ->delete();

            // Hapus varian produk
            DB::table('product_variants')
                ->where('product_id', $id)
                ->delete();

            // Hapus produk
            DB::table('products')
                ->where('id', $id)
                ->delete();

            // Commit transaksi database
            DB::commit();

            return ApiResponseHelper::success([], 'Product deleted successfully');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            Log::error('Error in deleteProduct: ' . $e->getMessage());

            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            // Validasi file gambar
            $validator = Validator::make($request->all(), [
                'image' => 'required|file|mimes:jpg,png,jpeg|max:10240',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Menangani upload gambar
            $imagePath = $request->file('image')->store('images', 'public');

            // Mengembalikan path gambar
            return ApiResponseHelper::success(['image_url' => asset('storage/' . $imagePath)], 'Image uploaded successfully');
        } catch (\Exception $e) {
            Log::error('Error in uploadImage: ' . $e->getMessage());
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

}
