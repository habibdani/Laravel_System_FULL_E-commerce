<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipping_districts')->insert([
            ['id' => 1, 'shipping_area_id' => 5, 'price' => 300000, 'name' => 'Cilincing', 'created_at' => '2024-03-27 16:15:23'],
            ['id' => 2, 'shipping_area_id' => 5, 'price' => 300000, 'name' => 'Kelapa Gading', 'created_at' => '2024-03-27 16:15:23'],
        ]);
    }
}
