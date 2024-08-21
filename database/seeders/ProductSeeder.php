<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 2,
                'title' => 'Hollow Besi',
                'created_by' => null,
                'created_at' => '2024-05-01 09:59:22',
                'updated_by' => null,
                'updated_at' => '2024-05-01 02:59:22',
                'deleted_at' => null,
                'product_type_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'unp besi sni',
                'created_by' => null,
                'created_at' => '2024-05-01 01:37:16',
                'updated_by' => null,
                'updated_at' => '2024-04-30 18:37:16',
                'deleted_at' => null,
                'product_type_id' => 2,
            ],
            [
                'id' => 4,
                'title' => 'Beton',
                'created_by' => null,
                'created_at' => '2024-04-30 17:01:54',
                'updated_by' => null,
                'updated_at' => '2024-04-30 17:01:54',
                'deleted_at' => null,
                'product_type_id' => 2,
            ]
        ]);
    }
}
