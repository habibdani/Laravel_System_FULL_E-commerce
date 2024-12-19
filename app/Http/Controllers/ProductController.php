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
            $filterByPencaarian = $request->input('filter_by_pencarian');
            $filterByProductId = $request->input('Product_id');
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
            if (!is_null($filterByPencaarian)) {
                $query .= " AND CONCAT(pt.name, ' ', pv.name) LIKE :fill";
                $bindings['fill'] = '%' . $filterByPencaarian . '%';
            }
            if (!is_null($filterByProductId)){
                $query .= " AND p.id = :filterbyproductID";
                $bindings['filterbyproductID'] = $filterByProductId;
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

    public function trueproductdetails(Request $request)
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
                    p.title AS product_name,
                    p.product_type_id
                FROM
                    products p
                    JOIN product_variants pv ON p.id = pv.product_id
                WHERE
                    p.id = ?
                    AND p.deleted_at IS NULL
                    AND pv.deleted_at IS NULL
                GROUP BY p.id
            ", [$id]);

            // Check if ProductUtama exists
            if (empty($productUtama)) {
                return ApiResponseHelper::error('Product not found.', 404);
            }

            // Query to get product variants
            $productVariants = DB::select("
                SELECT
                    pv.id AS product_variant_id,
                    CONCAT(pt.name, ' - ', pv.name) AS full_name_product,
                    SUBSTRING_INDEX(pv.image, '/storage/', -1) AS variant_image,
                    pvi.id AS variant_item_id,
                    pvi.name AS variant_item_name,
                    pvi.variant_item_type_id,
                    pv.descriptions,
                    pv.stock,
                    pv.po_status,
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
                    p.id = ?
                    AND p.deleted_at IS NULL
                    AND pt.deleted_at IS NULL
                    AND pv.deleted_at IS NULL
                GROUP BY
                    pv.id
            ", [$id]);

            // Organize the response structure
            $productDetails = [
                'id' => $productUtama[0]->id,
                'product_name' => $productUtama[0]->product_name,
                'product_type' => $productUtama[0]->product_type_id,
                'product_variant' => []
            ];

            // Group variants under the main product
            foreach ($productVariants as $variant) {
                // Query variant types for this product variant
                $varianttypes = DB::select("
                    SELECT
                        pv.id AS product_variant_id,
                        vit.id AS variant_item_type_id,
                        vit.name AS variant_item_type_name
                    FROM
                        product_variants pv
                        LEFT JOIN product_variant_items pvi ON pv.id = pvi.product_variant_id
                        LEFT JOIN variant_item_types vit ON vit.id = pvi.variant_item_type_id
                    WHERE
                        pv.id = ?
                        AND pvi.deleted_at IS NULL
                        AND vit.deleted_at IS NULL
                    GROUP BY vit.id
                ", [$variant->product_variant_id]);
            
                $variantItemDetails = []; // To store items for each variant type
            
                // Loop through each variant type
                foreach ($varianttypes as $varianttype) {
                    // Query for variant items within this type
                    $variantItems = DB::select("
                        SELECT
                            -- pv.id AS product_variant_id,
                            -- vit.id AS variant_item_type_id,
                            pvi.id AS variant_item_id,
                            pvi.name AS variant_item_name,
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
                    ", [$variant->product_variant_id, $varianttype->variant_item_type_id]);
            
                    // Add details of this variant type with its items
                    $variantItemDetails[] = [
                        // 'product_variant_id' => $varianttype->product_variant_id,
                        'variant_item_type_id' => $varianttype->variant_item_type_id,
                        'variant_item_type_name' => $varianttype->variant_item_type_name,
                        'items' => $variantItems
                    ];
                }
            
                // Add product variant details with the nested variant item details
                $productDetails['product_variant'][] = [
                    'product_variant_id' => $variant->product_variant_id,
                    'full_name_product' => $variant->full_name_product,
                    'variant_image' => $variant->variant_image,
                    'variant_item_id' => $variant->variant_item_id,
                    'variant_item_name' => $variant->variant_item_name,
                    'variant_item_type_id' => $variant->variant_item_type_id,
                    'descriptions' => $variant->descriptions,
                    'stock' => $variant->stock,
                    'price_display' => $variant->price_display,
                    'price' => $variant->price,
                    'variant_item_details' => $variantItemDetails // Nested details
                ];
            }
            
            // Check if the product exists
            if (empty($productDetails)) {
                return ApiResponseHelper::error('Product variant not found.', 404);
            }


            $data = response()->json($productDetails);
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
                    'pv.product_id',
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
                    'product_id' => $product->product_id,
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

    // Get All Banner Besar
    public function getBannerBesar()
    {
        try {
            $results = DB::select("SELECT * FROM banner_besar WHERE deleted_at IS NULL");
            return ApiResponseHelper::success($results, 'Banner besar retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Get Single Banner Besar by ID
    public function getBannerBesarById($id)
    {
        try {
            $results = DB::select("SELECT * FROM banner_besar WHERE id = ? AND deleted_at IS NULL", [$id]);
            if (empty($results)) {
                return ApiResponseHelper::error('Banner besar not found', 404);
            }
            return ApiResponseHelper::success($results[0], 'Banner besar retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Create Banner Besar
    public function createBannerBesar(Request $request)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'tittle' => 'nullable|string|max:255', // Tittle wajib diisi, maksimal 255 karakter
                'description' => 'nullable|string|max:500', // Description wajib diisi, maksimal 500 karakter
                'image' => 'required|string|url', // Image wajib diisi dan harus berupa URL yang valid
            ]);

            $tittle = $validatedData['tittle'] ?? null;
            $description = $validatedData['description'] ?? null;

            // Insert data ke database
            DB::insert("INSERT INTO banner_besar (tittle, description, image) VALUES (?, ?, ?)", [
                $tittle,
                $description,
                $validatedData['image'],
            ]);

            // Response sukses
            return response()->json([
                'success' => true,
                'message' => 'Banner besar created successfully',
                'data' => $validatedData,
            ], 201); // Status 201 untuk Created
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400); // Status 400 untuk Bad Request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error creating banner besar: ' . $e->getMessage());

            // Jika terjadi error lain
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // Tambahkan detail error untuk debugging
            ], 500); // Status 500 untuk Internal Server Error
        }
    }


    // Update Banner Besar
    public function updateBannerBesar(Request $request, $id)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'tittle' => 'nullable|string|max:255', // Title tidak wajib, maksimal 255 karakter
                'description' => 'nullable|string|max:500', // Description tidak wajib, maksimal 500 karakter
                'image' => 'required|string|url', // Image tetap wajib diisi dan harus berupa URL yang valid
            ]);

            // Atur nilai default jika tittle atau description tidak disediakan
            $tittle = $validatedData['tittle'] ?? null;
            $description = $validatedData['description'] ?? null;

            // Update data di database
            $updated = DB::update("UPDATE banner_besar SET tittle = ?, image = ?, description = ? WHERE id = ?", [
                $tittle,
                $validatedData['image'],
                $description,
                $id,
            ]);

            if ($updated) {
                // Jika data berhasil diupdate
                return ApiResponseHelper::success(null, 'Banner besar updated successfully');
            } else {
                // Jika ID tidak ditemukan
                return ApiResponseHelper::error('Banner besar not found', 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400); // Status 400 untuk validasi error
        } catch (\Exception $e) {
            // Jika terjadi error lainnya
            \Log::error('Error updating banner besar: ' . $e->getMessage());
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Delete Banner Besar
    public function deleteBannerBesar($id)
    {
        try {
            $deleted = DB::update("UPDATE banner_besar SET deleted_at = NOW() WHERE id = ?", [$id]);

            if ($deleted) {
                return ApiResponseHelper::success(null, 'Banner besar deleted successfully');
            } else {
                return ApiResponseHelper::error('Banner besar not found', 404);
            }
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Get All Banner Kecil
    public function getBannerKecil()
    {
        try {
            $results = DB::select("SELECT * FROM banner_kecil WHERE deleted_at IS NULL");
            return ApiResponseHelper::success($results, 'Banner kecil retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Update Banner Kecil
    public function updateBannerKecil(Request $request, $id)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'text' => 'required|string|max:255', // Text wajib diisi, maksimal 255 karakter
                'image' => 'required|string|url', // Image wajib diisi, harus berupa URL yang valid
            ]);
    
            // Update data di database
            $updated = DB::update("UPDATE banner_kecil SET text = ?, image = ? WHERE id = ?", [
                $validatedData['text'],
                $validatedData['image'],
                $id,
            ]);
    
            if ($updated) {
                // Jika data berhasil diperbarui
                return response()->json([
                    'success' => true,
                    'message' => 'Banner kecil updated successfully',
                    'data' => $validatedData, // Kembalikan data yang diupdate
                ], 200); // Status 200 untuk OK
            } else {
                // Jika ID tidak ditemukan
                return response()->json([
                    'success' => false,
                    'message' => 'Banner kecil not found',
                ], 404); // Status 404 untuk Not Found
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Detail kesalahan validasi
            ], 400); // Status 400 untuk Bad Request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error updating banner kecil: ' . $e->getMessage());
    
            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // Tambahkan detail error untuk debugging
            ], 500); // Status 500 untuk Internal Server Error
        }
    }    

    // Get Single Banner Kecil by ID
    public function getBannerKecilById($id)
    {
        try {
            $results = DB::select("SELECT * FROM banner_kecil WHERE id = ? AND deleted_at IS NULL", [$id]);
            if (empty($results)) {
                return ApiResponseHelper::error('Banner kecil not found', 404);
            }
            return ApiResponseHelper::success($results[0], 'Banner kecil retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Create Banner Kecil
    public function createBannerKecil(Request $request)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'text' => 'required|string|max:255', // Text wajib diisi, berupa string, maksimal 255 karakter
                'image' => 'required|string|url', // Image wajib diisi, berupa URL yang valid
            ]);

            // Insert data ke database
            DB::insert("INSERT INTO banner_kecil (text, image) VALUES (?, ?)", [
                $validatedData['text'],
                $validatedData['image'],
            ]);

            // Return response sukses
            return response()->json([
                'success' => true,
                'message' => 'Banner kecil created successfully',
                'data' => $validatedData, // Kembalikan data yang berhasil dibuat
            ], 201); // Status 201 untuk Created
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return error jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Detail kesalahan validasi
            ], 400); // Status 400 untuk Bad Request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error creating banner kecil: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // Tambahkan detail error untuk debugging
            ], 500); // Status 500 untuk Internal Server Error
        }
    }

    // Delete Banner Kecil
    public function deleteBannerKecil($id)
    {
        try {
            $deleted = DB::update("UPDATE banner_kecil SET deleted_at = NOW() WHERE id = ?", [$id]);

            if ($deleted) {
                return ApiResponseHelper::success(null, 'Banner kecil deleted successfully');
            } else {
                return ApiResponseHelper::error('Banner kecil not found', 404);
            }
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Get All Banner Kecil
    public function getBannerKecil2()
    {
        try {
            $results = DB::select("SELECT * FROM banner_kecil_2");
            return ApiResponseHelper::success($results, 'Banner kecil 2 retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Update Banner Kecil
    public function updateBannerKecil2(Request $request, $id)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'image' => 'required|string|url', // Image wajib diisi, harus berupa URL yang valid
            ]);

            // Update data di database
            $updated = DB::update("UPDATE banner_kecil_2 SET image = ? WHERE id = ?", [
                $validatedData['image'],
                $id,
            ]);

            if ($updated) {
                // Jika data berhasil diperbarui
                return response()->json([
                    'success' => true,
                    'message' => 'Banner kecil 2 updated successfully',
                    'data' => $validatedData, // Kembalikan data yang diupdate
                ], 200); // Status 200 untuk OK
            } else {
                // Jika ID tidak ditemukan
                return response()->json([
                    'success' => false,
                    'message' => 'Banner kecil not found',
                ], 404); // Status 404 untuk Not Found
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Detail kesalahan validasi
            ], 400); // Status 400 untuk Bad Request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error updating banner kecil: ' . $e->getMessage());

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // Tambahkan detail error untuk debugging
            ], 500); // Status 500 untuk Internal Server Error
        }
    }  
    
    public function getBannerBestProduct()
    {
        try {
            $results = DB::select("SELECT * FROM banner_best_product");
            return ApiResponseHelper::success($results, 'Banner besar retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function updateBannerBestProduct(Request $request, $id)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'tittle' => 'nullable|string|max:255', 
                'text' => 'nullable|string|max:500', 
                'image' => 'required|string|url',
            ]);

            // Atur nilai default jika tittle atau description tidak disediakan
            $tittle = $validatedData['tittle'] ?? null;
            $text = $validatedData['text'] ?? null;

            // Update data di database
            $updated = DB::update("UPDATE banner_best_product SET tittle = ?, image = ?, text = ? WHERE id = 1", [
                $tittle,
                $validatedData['image'],
                $text,
            ]);

            if ($updated) {
                // Jika data berhasil diupdate
                return ApiResponseHelper::success(null, 'Banner best product updated successfully');
            } else {
                // Jika ID tidak ditemukan
                return ApiResponseHelper::error('Banner best product not found', 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400); // Status 400 untuk validasi error
        } catch (\Exception $e) {
            // Jika terjadi error lainnya
            \Log::error('Error updating banner best product: ' . $e->getMessage());
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
                'product_name' => 'sometimes|string|max:255',
                'product_type_id' => 'sometimes|integer|exists:product_types,id',
                'product_variant' => 'sometimes|array',
                'product_variant.*.id' => 'required|integer|exists:product_variants,id',
                'product_variant.*.product_variant_name' => 'sometimes|string|max:255',
                'product_variant.*.price' => 'sometimes|numeric',
                'product_variant.*.stock' => 'sometimes|integer',
                'product_variant.*.image_url' => 'sometimes|string|max:255',
                'product_variant.*.po_status' => 'sometimes|boolean',
                'product_variant.*.descriptions' => 'sometimes|string|max:1000',
                'product_variant.*.product_variant_item' => 'sometimes|array',
                'product_variant.*.product_variant_item.*.id' => 'required|integer|exists:product_variant_items,id',
                'product_varaint.*.product_varaint_item.*.variant_item_type_id' => 'required|integer|exists:product_varaint_item,variant_item_type_id',
                'product_variant.*.product_variant_item.*.product_variant_item_name' => 'sometimes|string|max:255',
                'product_variant.*.product_variant_item.*.price_variant' => 'sometimes|numeric',
            ]);

            if ($validator->fails()) {
                return ApiResponseHelper::validationError($validator->errors());
            }

            // Ambil data dari request
            $productData = $request->only(['product_name', 'product_type_id']);
            $productVariants = $request->input('product_variant', []);

            // Memulai transaksi database
            DB::beginTransaction();

            // Update tabel product
            DB::table('products')
                ->where('id', $id)
                ->update([
                    'title' => $productData['product_name'] ?? DB::raw('title'),
                    'product_type_id' => $productData['product_type_id'] ?? DB::raw('product_type_id'),
                    'updated_at' => now(),
                ]);

            // Update product_variant dan product_variant_item
                foreach ($productVariants as $variant) {
                    $existingVariant = DB::table('product_variants')
                        ->where('deleted_at', null)
                        ->where('id', $variant['id'])
                        ->where('product_id', $id)
                        ->first();
            
                    if ($existingVariant) {
                        // Jika ditemukan, lakukan update
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
                    } else {
                        // Jika tidak ditemukan, lakukan insert
                        DB::table('product_variants')->insert([
                            'product_id' => $id,
                            'name' => $variant['product_variant_name'] ?? '',
                            'price' => $variant['price'] ?? 0,
                            'stock' => $variant['stock'] ?? 0,
                            'image' => $variant['image_url'] ?? null,
                            'po_status' => $variant['po_status'] ?? null,
                            'descriptions' => $variant['descriptions'] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    if (!empty($variant['product_variant_item'])) {
                        foreach ($variant['product_variant_item'] as $item) {
                            $existingItem = DB::table('product_variant_items')
                                ->where('deleted_at', null)
                                ->where('id', $item['id'])
                                ->where('product_variant_id', $variant['id'])
                                ->first();
            
                            if ($existingItem) {
                                // Jika ditemukan, lakukan update
                                DB::table('product_variant_items')
                                    ->where('id', $item['id'])
                                    ->update([
                                        'name' => $item['product_variant_item_name'] ?? DB::raw('name'),
                                        'variant_item_type_id' => $item['variant_item_type_id'] ?? DB::raw('variant_item_type_id'),
                                        'add_price' => $item['price_variant'] ?? DB::raw('add_price'),
                                        'updated_at' => now(),
                                    ]);
                            } elseif (!empty($item['product_variant_item_name'])) {
                                // Jika tidak ditemukan, lakukan insert
                                DB::table('product_variant_items')->insert([
                                    'name' => $item['product_variant_item_name'],
                                    'product_variant_id' => $variant['id'],
                                    'variant_item_type_id' => $item['variant_item_type_id'] ?? null,
                                    'add_price' => $item['price_variant'] ?? 0,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }

            // Commit transaksi database
            DB::commit();

            return ApiResponseHelper::success('Product updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in updateProduct: ' . $e->getMessage());

            return ApiResponseHelper::error('Something went wrong: ' . $e->getMessage(), 500);
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
                ->where('product_variant_id', $id)
                ->update(['deleted_at' => $currentTimestamp]);

            // Soft delete varian produk
            DB::table('product_variants')
                ->where('id', $id)
                ->update(['deleted_at' => $currentTimestamp]);

            // Soft delete produk
            // DB::table('products')
            //     ->where('id', $id)
            //     ->update(['deleted_at' => $currentTimestamp]);

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

    // Get All Info Rekening
    public function getInfoRekening()
    {
        try {
            $results = DB::select("SELECT * FROM info_rekening WHERE deleted_at IS NULL");
            return ApiResponseHelper::success($results, 'Info rekening retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Get Single Info Rekening by ID
    public function getInfoRekeningById($id)
    {
        try {
            $results = DB::select("SELECT * FROM info_rekening WHERE id = ? AND deleted_at IS NULL", [$id]);
            if (empty($results)) {
                return ApiResponseHelper::error('Info rekening not found', 404);
            }
            return ApiResponseHelper::success($results[0], 'Info rekening retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Create Info Rekening
    public function createInfoRekening(Request $request)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'nama' => 'required|string|max:100', // Nama harus berupa string dengan maksimal 100 karakter
                'nomor_rekening' => 'required|string|regex:/^\d+$/|min:10|max:20', // Nomor rekening hanya angka, minimal 10, maksimal 20 karakter
                'nama_bank' => 'required|string|max:50', // Nama bank harus berupa string dengan maksimal 50 karakter
            ]);

            // Insert data ke database
            DB::insert("INSERT INTO info_rekening (nama, nomor_rekening, nama_bank) VALUES (?, ?, ?)", [
                $validatedData['nama'],
                $validatedData['nomor_rekening'],
                $validatedData['nama_bank'],
            ]);

            // Return response sukses
            return ApiResponseHelper::success(null, 'Info rekening created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal, tangkap pesan error
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400); // Status code 400 untuk bad request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error creating info rekening: ' . $e->getMessage());

            // Return error response
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }



    // Update Info Rekening
    public function updateInfoRekening(Request $request, $id)
    {
        try {
            // Validasi payload
            $validatedData = $request->validate([
                'nama' => 'required|string|max:100', // Nama harus berupa string dengan maksimal 100 karakter
                'nomor_rekening' => 'required|string|regex:/^\d+$/|min:10|max:20', // Nomor rekening hanya angka, minimal 10, maksimal 20 karakter
                'nama_bank' => 'required|string|max:50', // Nama bank harus berupa string dengan maksimal 50 karakter
            ]);

            // Update data di database
            $updated = DB::update("UPDATE info_rekening SET nama = ?, nomor_rekening = ?, nama_bank = ? WHERE id = ?", [
                $validatedData['nama'],
                $validatedData['nomor_rekening'],
                $validatedData['nama_bank'],
                $id,
            ]);

            if ($updated) {
                // Return response sukses jika data berhasil diupdate
                return ApiResponseHelper::success(null, 'Info rekening updated successfully');
            } else {
                // Return error jika ID tidak ditemukan
                return ApiResponseHelper::error('Info rekening not found', 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return error jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 400); // Status code 400 untuk bad request
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error updating info rekening: ' . $e->getMessage());

            // Return error response
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }


    // Delete Info Rekening
    public function deleteInfoRekening($id)
    {
        try {
            $deleted = DB::update("UPDATE info_rekening SET deleted_at = NOW() WHERE id = ?", [$id]);

            if ($deleted) {
                return ApiResponseHelper::success(null, 'Info rekening deleted successfully');
            } else {
                return ApiResponseHelper::error('Info rekening not found', 404);
            }
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Get Info WA
    public function getInfoWa()
    {
        try {
            $results = DB::select("SELECT * FROM info_wa LIMIT 1");
            if (empty($results)) {
                return ApiResponseHelper::error('Info WA not found', 404);
            }
            return ApiResponseHelper::success($results[0], 'Info WA retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Update Info WA
    public function updateInfoWa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nomorwa' => 'required|string',
        ]);

        try {
            $updated = DB::update("UPDATE info_wa SET nama = ?, nomorwa = ? WHERE id = 1", [
                $request->nama,
                $request->nomorwa,
            ]);

            if ($updated) {
                return ApiResponseHelper::success(null, 'Info WA updated successfully');
            } else {
                return ApiResponseHelper::error('Info WA not found', 404);
            }
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    // Delete Info WA
    public function deleteInfoWa()
    {
        try {
            $deleted = DB::delete("DELETE FROM info_wa WHERE id = 1");

            if ($deleted) {
                return ApiResponseHelper::success(null, 'Info WA deleted successfully');
            } else {
                return ApiResponseHelper::error('Info WA not found', 404);
            }
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function getInfoTypeClient($id)
    {
        try {
            // Validate if the ID is provided
            if (!$id) {
                return ApiResponseHelper::validationError('Client ID is required', 400);
            }

            $results = DB::select("SELECT * FROM client_types WHERE id = ?", [$id]);
            if (empty($results)) {
                return ApiResponseHelper::error('Info client not found', 404);
            }
            return ApiResponseHelper::success($results[0], 'Info client retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

    public function updatePricePercentage(Request $request)
    {
        try {
            // Ambil nilai dari body request
            $id = $request->input('id');
            $price_percentage = $request->input('price_percentage');

            // Validate if the ID is provided
            if (!$id) {
                return ApiResponseHelper::validationError('Client ID is required', 400);
            }

            // Validate if price_percentage is provided and is numeric
            if (!isset($price_percentage) || !is_numeric($price_percentage)) {
                return ApiResponseHelper::validationError('Price percentage must be a valid number', 400);
            }

            // Execute the update query
            $updated = DB::update("UPDATE client_types SET price_persentage = ? WHERE id = ?", [$price_percentage, $id]);

            // Check if the update was successful
            if ($updated) {
                return ApiResponseHelper::success(null, 'Price percentage updated successfully');
            }

            // If no rows were affected, return an error
            return ApiResponseHelper::error('No client found with the provided ID', 404);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Something went wrong', 500);
        }
    }

}
