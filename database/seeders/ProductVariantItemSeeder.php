<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_variant_items')->insert([
            [
                'id' => 1,
                'product_variant_id' => 1,
                'variant_item_type_id' => 1,
                'name' => '15x15',
                'add_price' => '1000',
                'created_at' => '2024-05-01 09:59:22',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'product_variant_id' => 1,
                'variant_item_type_id' => 2,
                'name' => '1.1mm',
                'add_price' => '1000',
                'created_at' => '2024-05-01 09:59:22',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'product_variant_id' => 2,
                'variant_item_type_id' => 1,
                'name' => '65 x 42 x 5,5 sni',
                'add_price' => '1000',
                'created_at' => '2024-05-01 01:37:16',
                'updated_at' => '2024-04-30 18:37:16',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'product_variant_id' => 1,
                'variant_item_type_id' => 1,
                'name' => '100m',
                'add_price' => '1800',
                'created_at' => '2024-05-01 09:59:22',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
            ],
            [
                'id' => 5,
                'product_variant_id' => 1,
                'variant_item_type_id' => 1,
                'name' => '90CM',
                'add_price' => '1700',
                'created_at' => '2024-05-01 09:59:22',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
            ],
            [
                'id' => 6,
                'product_variant_id' => 14,
                'variant_item_type_id' => 1,
                'name' => '12',
                'add_price' => '500',
                'created_at' => '2024-04-30 16:33:44',
                'updated_at' => '2024-04-30 16:33:44',
                'deleted_at' => null,
            ],
            [
                'id' => 7,
                'product_variant_id' => 14,
                'variant_item_type_id' => 1,
                'name' => '111',
                'add_price' => '0',
                'created_at' => '2024-04-30 16:33:44',
                'updated_at' => '2024-04-30 16:33:44',
                'deleted_at' => null,
            ],
            [
                'id' => 8,
                'product_variant_id' => 15,
                'variant_item_type_id' => 1,
                'name' => '123',
                'add_price' => '1300',
                'created_at' => '2024-04-30 16:34:19',
                'updated_at' => '2024-04-30 16:34:19',
                'deleted_at' => null,
            ],
            [
                'id' => 9,
                'product_variant_id' => 16,
                'variant_item_type_id' => 1,
                'name' => '1x1m',
                'add_price' => '1100',
                'created_at' => '2024-04-30 17:01:54',
                'updated_at' => '2024-04-30 17:01:54',
                'deleted_at' => null,
            ],
            [
                'id' => 10,
                'product_variant_id' => 16,
                'variant_item_type_id' => 1,
                'name' => '10cm',
                'add_price' => '1200',
                'created_at' => '2024-04-30 17:01:54',
                'updated_at' => '2024-04-30 17:01:54',
                'deleted_at' => null,
            ],
            // Tambahkan data lainnya sesuai dengan yang diberikan
        ]);
    }
}
