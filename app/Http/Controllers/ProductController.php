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
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function listproduct(Request $request)
    {
        try {
            // Ambil parameter dari request
            $product_type_id = $request->input('product_type_id');
            $filter = $request->input('filter');

            // Mulai membangun query dasar
            $query = "
                SELECT
                    p.id as product_id,
                    p.title as product_name,
                    p.product_type_id,
                    pt.name as type_name,
                    pv.id as product_variant_id,
                    CASE WHEN pv.po_status = 1 THEN 'Preorder' ELSE NULL END AS preorder,
                    CONCAT(pt.name, ' ', pv.name) as full_name_product,
                    pv.name as variant_name,
                    pv.price as variant_price,
                    SUBSTRING_INDEX(pv.image, '/storage/', -1) as variant_image
                FROM
                    products p
                    JOIN product_types pt ON p.product_type_id = pt.id
                    JOIN product_variants pv ON p.id = pv.product_id
                WHERE
                p.deleted_at IS NULL
                AND pt.deleted_at IS NULL
                AND pv.deleted_at IS NULL
            ";

            // Prepare binding parameters
            $bindings = [];

            // Tambahkan kondisi untuk product_type_id jika ada
            if (!is_null($product_type_id)) {
                $query .= " AND pt.id = :product_type_id";
                $bindings['product_type_id'] = $product_type_id;
            }

            // Tambahkan kondisi untuk filter explore atau special
            if ($filter === 'explore') {
                $query .= " AND pt.id IN (1, 2, 3)";
            } elseif ($filter === 'special') {
                $query .= " AND pv.price < 1000000";
            }

            // Jalankan query dengan parameter binding
            $results = DB::select($query, $bindings);

            // Return hasil query sebagai response JSON
            $data = response()->json($results);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            // Return error jika ada masalah
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function productdetails(Request $request)
    {
        // Get the 'id' parameter from the query string
        $id = $request->query('id');

        // Validate input
        if (!$id || !is_numeric($id)) {
            return ApiResponseHelper::error('ID is required and must be a valid integer.', 400);
        }

        try {
            $productUtama = DB::select("
                SELECT
                    p.id,
                    p.title product_name,
                    p.product_type_id
                FROM
                    products p
                    JOIN product_variants pv ON p.id = pv.product_id
                WHERE pv.id = ?
                    AND p.deleted_at IS NULL
                    AND pv.deleted_at IS NULL"
                , [$id]);

            // Query to get product details
            $product = DB::select("
                SELECT
                    pv.id product_variant_id,
                    CONCAT(pt.name, ' - ', pv.name) full_name_product,
                    SUBSTRING_INDEX(pv.image, '/storage/', -1) as variant_image,
                    pvi.id variant_item_id,
                    pvi.name variant_item_name,
                    pvi.variant_item_type_id,
                    pv.descriptions,
                    pv.stock,
                    CASE
                        WHEN pv.price = (pv.price + COALESCE(MAX(pvi.add_price), 0)) THEN
                            CONCAT('Rp ', FORMAT(pv.price, 0))
                        ELSE
                            CONCAT('Rp ', FORMAT(pv.price, 0), ' - Rp ', FORMAT((pv.price + COALESCE(MAX(pvi.add_price), 0)), 0))
                    END AS price_display,
                    pv.price
                FROM
                    products p
                    JOIN product_types pt ON p.product_type_id = pt.id
                    JOIN product_variants pv ON p.id = pv.product_id
                    LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                    LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                WHERE
                    pv.id = ?
                    AND p.deleted_at IS NULL
                    AND pt.deleted_at IS NULL
                    AND pv.deleted_at IS NULL
                GROUP BY
                    pv.id
            ", [$id]);

            // Query to get variant types
            $varianttypes = DB::select("
                SELECT
                    vit.id variant_item_type_id,
                    vit.name variant_item_type_name
                FROM
                    product_variants pv
                    LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                    LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                WHERE
                    pv.id = ?
                    AND pvi.deleted_at IS NULL
                    AND vit.deleted_at IS NULL
                GROUP BY vit.id
            ", [$id]);

            // Initialize an array to store variant item details
            $variantItemDetails = [];

            // Loop through each variant type to get its items
            foreach ($varianttypes as $varianttype) {
                $variantItems = DB::select("
                    SELECT
                        pv.id product_variant_id,
                        pvi.id variant_item_id,
                        pvi.name variant_item_name,
                        COALESCE(pvi.add_price, 0) AS add_price
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                        LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                    WHERE
                        pv.id = ?
                        AND vit.id = ?
                        AND pvi.deleted_at IS NULL
                        AND vit.deleted_at IS NULL
                ", [$id, $varianttype->variant_item_type_id]);

                $variantItemDetails[] = [
                    'variant_item_type_id' => $varianttype->variant_item_type_id,
                    'variant_item_type_name' => $varianttype->variant_item_type_name,
                    'items' => $variantItems
                ];
            }

            // Check if the product exists
            if (empty($product)) {
                return ApiResponseHelper::error('Product variant not found.', 404);
            }

            // Prepare the response
            $response = [
                'headers' => [
                    'product_utama' => $productUtama[0] ?? null, // Including $productUtama
                ],
                'product' => $product[0], // Single product result
                'variant_types' => $variantItemDetails,
            ];

            $data = response()->json($response);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            Log::error('Error in productdetails: ' . $e->getMessage());

            return ApiResponseHelper::error($e, 500);
        }
    }

    public function listproductData(Request $request)
    {
        try {
            $perPage = 10; // Jumlah item per halaman, dalam hal ini 25
            $page = $request->input('page', 1); // Mendapatkan nomor halaman dari request, default 1
            $search = $request->input('search'); // Mendapatkan input pencarian dari request
            $order = $request->input('order', 'ASC'); // Mendapatkan input pengurutan dari request, default ASC
            $sortType = $request->input('sortType', 1); // Default sorting type is Best Match

            $productsQuery = DB::table('products as p')
                ->join('product_types as pt', 'p.product_type_id', '=', 'pt.id')
                ->join('product_variants as pv', 'p.id', '=', 'pv.product_id')
                ->leftJoin('product_variant_items as pvi', 'pv.id', '=', 'pvi.product_variant_id')
                ->leftJoin('variant_item_types as vit', 'vit.id', '=', 'pvi.variant_item_type_id')
                ->whereNull('p.deleted_at')
                ->whereNull('pt.deleted_at')
                ->whereNull('pv.deleted_at')
                ->groupBy('pv.id')
                ->select(
                    'pv.id as product_variant_id',
                    DB::raw("CONCAT(pt.name, ' - ', pv.name) as full_name_product"),
                    DB::raw("SUBSTRING_INDEX(pv.image, '/storage/', -1) as variant_image"),
                    'pv.descriptions',
                    'pv.stock',
                    DB::raw("
                        CASE
                            WHEN pv.price = (pv.price + COALESCE(MAX(pvi.add_price), 0)) THEN
                                CONCAT('Rp ', FORMAT(pv.price, 0))
                            ELSE
                                CONCAT('Rp ', FORMAT(pv.price, 0), ' - Rp ', FORMAT((pv.price + COALESCE(MAX(pvi.add_price), 0)), 0))
                        END AS price_display
                    "),
                    'pv.price'
                );

            // Jika ada input search, tambahkan klausa WHERE untuk pencarian
            if (!empty($search)) {
                $productsQuery->where(DB::raw("CONCAT(pt.name, ' - ', pv.name)"), 'LIKE', "%{$search}%");
            }

            // Handle sorting based on sortType
            switch ($sortType) {
                case 1:
                    // Best Match (can use some custom sorting logic here if needed)
                    $productsQuery->orderBy('pv.name', $order);  // Sort by name as an example for Best Match
                    break;
                case 2:
                    // Price Low to High
                    $productsQuery->orderBy('pv.price', 'ASC');
                    break;
                case 3:
                    // Price High to Low
                    $productsQuery->orderBy('pv.price', 'DESC');
                    break;
                default:
                    // Default sorting (Best Match)
                    $productsQuery->orderBy('pv.name', $order);  // Fallback to name sorting
                    break;
            }

            // Paginate query
            $products = $productsQuery->paginate($perPage, ['*'], 'page', $page);

            $productsWithVariantItems = [];

            foreach ($products as $product) {
                // Fetch variant item types for each product variant
                $varianttypes = DB::select("
                    SELECT
                        vit.id as variant_item_type_id,
                        vit.name as variant_item_type_name
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                        LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                    WHERE
                        pv.id = ?
                        AND pvi.deleted_at IS NULL
                        AND vit.deleted_at IS NULL
                    GROUP BY vit.id
                ", [$product->product_variant_id]);

                // Initialize an empty array to store all variant types and their corresponding items
                $variantItemDetails = [];

                foreach ($varianttypes as $varianttype) {
                    // Fetch variant items for each variant item type
                    $variantItems = DB::select("
                        SELECT
                            pvi.id as variant_item_id,
                            pvi.name as variant_item_name,
                            CASE WHEN pvi.add_price IS NULL THEN 0 ELSE pvi.add_price END AS add_price
                        FROM
                            product_variants pv
                            LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                            LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                        WHERE
                            pv.id = ?
                            AND vit.id = ?
                            AND pvi.deleted_at IS NULL
                            AND vit.deleted_at IS NULL
                    ", [$product->product_variant_id, $varianttype->variant_item_type_id]);

                    // Only add if there are items for the variant type
                    if (!empty($variantItems)) {
                        $variantItemDetails[] = [
                            'variant_item_type_id' => $varianttype->variant_item_type_id,
                            'variant_item_type_name' => $varianttype->variant_item_type_name,
                            'items' => $variantItems
                        ];
                    }
                }

                $productsWithVariantItems[] = [
                    'product_variant_id' => $product->product_variant_id,
                    'full_name_product' => $product->full_name_product,
                    'descriptions' => $product->descriptions,
                    'variant_image' => $product->variant_image,
                    'price_display' => $product->price_display,
                    'stock' =>$product->stock,
                    'variant_item_details' => $variantItemDetails // Add variant items grouped by their types
                ];
            }

            // Tambahkan count produk dan pagination links
            $data = [
                'count' => $products->total(),
                'products' => $productsWithVariantItems,
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'next_page_url' => $products->nextPageUrl(),
                    'prev_page_url' => $products->previousPageUrl(),
                ]
            ];

            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            // Return error jika ada masalah
            Log::error('Error dalam listproductData: ' . $e->getMessage());
            return ApiResponseHelper::error($e->getMessage(), 500);
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

    public function getListDropdown(Request $request)
    {
        try {
            // Ambil parameter 'id' dari request, jika ada
            $id = $request->query('id');

            // Inisialisasi array untuk menyimpan parameter
            $params = [];

            // Bangun query SQL secara dinamis berdasarkan kondisi
            $sql = "
                SELECT
                    id,
                    `name`
                FROM
                    product_types
                WHERE deleted_at IS NULL
            ";

            // Jika parameter 'id' diberikan, tambahkan kondisi ke query dan parameter
            if (!empty($id)) {
                $sql .= " AND id = ?";
                $params[] = $id;
            }

            // Eksekusi query dengan parameter (jika ada)
            $listproducttypes = DB::select($sql, $params);

            // Inisialisasi array untuk menyimpan hasil akhir
            $result = [];

            // Loop melalui setiap product type
            foreach ($listproducttypes as $producttype) {
                // Mengambil daftar produk berdasarkan product type id
                $listproducts = DB::select("
                    SELECT
                        id,
                        title
                    FROM
                        products
                    WHERE deleted_at IS NULL
                    AND product_type_id = ?", [$producttype->id]);

                // Array untuk menyimpan produk beserta variannya
                $productData = [];

                foreach ($listproducts as $product) {
                    // Mengambil daftar variant produk berdasarkan product id
                    $listproductvariants = DB::select("
                        SELECT
                            id,
                            `name`
                        FROM
                            product_variants
                        WHERE deleted_at IS NULL
                        AND product_id = ?", [$product->id]);

                    // Menyimpan produk dan variannya ke dalam struktur yang diinginkan
                    $productData[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'variants' => $listproductvariants
                    ];
                }

                // Menyimpan product type, produk, dan varian terkait ke dalam hasil akhir
                $result[] = [
                    'product_type' => [
                        'id' => $producttype->id,
                        'name' => $producttype->name,
                        'products' => $productData // Produk disimpan di bawah product_type
                    ]
                ];
            }

            // Mengirim data sebagai respons JSON
            $data = response()->json($result);
            return ApiResponseHelper::success($data, 'Data retrieved successfully');
        } catch (\Exception $e) {
            // Mengirim respons error jika terjadi kesalahan
            return ApiResponseHelper::error('Something went wrong', 500, $e->getMessage());
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
                'product_variant.*.stock' => 'required|numeric|min:0',
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
                    'stock' => $variant['stock'],
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
                'product_variant.*.stock' => 'required|numeric|min:0',
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
                            'stock' => $variant['stock'] ?? DB::raw('stock'),
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

            $currentTimestamp = now(); // Dapatkan waktu saat ini untuk kolom deleted_at

            // Soft delete item varian produk
            DB::table('product_variant_items')
                ->whereIn('product_variant_id', function ($query) use ($id) {
                    $query->select('id')
                        ->from('product_variants')
                        ->where('product_id', $id);
                })
                ->update(['deleted_at' => $currentTimestamp]);

            // Soft delete varian produk
            DB::table('product_variants')
                ->where('product_id', $id)
                ->update(['deleted_at' => $currentTimestamp]);

            // Soft delete produk
            DB::table('products')
                ->where('id', $id)
                ->update(['deleted_at' => $currentTimestamp]);

            // Commit transaksi database
            DB::commit();

            return ApiResponseHelper::success([], 'Product soft-deleted successfully');
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

    public function deleteImage(Request $request)
    {
        try {
            // Validasi input, pastikan hanya menerima nama file gambar
            $validator = Validator::make($request->all(), [
                'image_url' => 'required|string',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Ambil nama file gambar dari input 'image_url'
            $imagePath = 'images/' . $request->image_url;

            // Periksa apakah file gambar ada di storage
            if (Storage::disk('public')->exists($imagePath)) {
                // Hapus file gambar dari storage
                Storage::disk('public')->delete($imagePath);

                return ApiResponseHelper::success([], 'Image deleted successfully');
            } else {
                return ApiResponseHelper::error('Image not found', 404);
            }
        } catch (\Exception $e) {
            Log::error('Error in deleteImage: ' . $e->getMessage());
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

}
