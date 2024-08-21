<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_variants')->insert([
            [
                'id' => 1,
                'name' => 'Hollow Besi 15 x 15',
                'price' => 10000000,
                'descriptions' => null,
                'po_status' => 1,
                'product_id' => 2,
                'created_at' => '2024-03-31 23:32:13',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 2,
                'name' => 'SNI',
                'price' => 1000000,
                'descriptions' => null,
                'po_status' => 1,
                'product_id' => 3,
                'created_at' => '2024-04-21 16:06:40',
                'updated_at' => '2024-04-30 18:37:16',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 9,
                'name' => 'Varian Baru',
                'price' => 900000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:21:30',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 10,
                'name' => 'Varian Baru',
                'price' => 900000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:21:48',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 11,
                'name' => 'Varian Baru',
                'price' => 900000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:22:11',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 12,
                'name' => 'Varian Baru',
                'price' => 900000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:22:48',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 13,
                'name' => 'Coba Variant',
                'price' => 90000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:25:50',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 14,
                'name' => 'Cobs',
                'price' => 2000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:33:44',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 15,
                'name' => 'Hans',
                'price' => 90000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 2,
                'created_at' => '2024-04-30 16:34:19',
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'image' => null,
            ],
            [
                'id' => 16,
                'name' => 'Beton Super',
                'price' => 900000,
                'descriptions' => null,
                'po_status' => 0,
                'product_id' => 4,
                'created_at' => '2024-04-30 17:01:54',
                'updated_at' => '2024-04-30 17:01:54',
                'deleted_at' => null,
                'image' => null,
            ],
            // Tambahkan data lainnya sesuai dengan yang diberikan
        ]);
    }
}
