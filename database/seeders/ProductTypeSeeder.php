<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'id' => 1,
                'name' => 'Besi',
                'created_at' => '2024-04-21 14:33:29',
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Struktural',
                'created_at' => '2024-04-21 16:04:29',
                'updated_at' => null,
                'deleted_at' => null,
            ]
        ]);
    }
};
