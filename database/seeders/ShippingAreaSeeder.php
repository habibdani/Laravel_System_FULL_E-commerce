<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('shipping_areas')->insert([
            ['id' => 1, 'name' => 'Jakarta Pusat', 'created_at' => '2024-03-27 16:22:02', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 2, 'name' => 'Jakarta Timur', 'created_at' => '2024-03-27 16:22:02', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 3, 'name' => 'Jakarta Barat', 'created_at' => '2024-03-27 16:22:18', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 4, 'name' => 'Jakarta Selatan', 'created_at' => '2024-03-27 16:22:18', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 5, 'name' => 'Jakarta Utara', 'created_at' => '2024-03-27 16:22:34', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 6, 'name' => 'Kota Bekasi', 'created_at' => '2024-03-27 16:29:36', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 7, 'name' => 'Kab Bekasi', 'created_at' => '2024-03-27 16:29:36', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 8, 'name' => 'Kab Bogor', 'created_at' => '2024-03-27 16:30:23', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 9, 'name' => 'Kota Bogor', 'created_at' => '2024-03-27 16:30:23', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 10, 'name' => 'Kota Depok', 'created_at' => '2024-03-27 16:30:52', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 11, 'name' => 'Kota Tangerang', 'created_at' => '2024-03-27 16:30:52', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 12, 'name' => 'Kota Tangerang Selatan', 'created_at' => '2024-03-27 16:31:35', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 13, 'name' => 'Kab Tangerang', 'created_at' => '2024-03-27 16:31:35', 'updated_at' => null, 'deleted_at' => null],
            ['id' => 14, 'name' => 'Kab Serang', 'created_at' => '2024-03-27 16:31:59', 'updated_at' => null, 'deleted_at' => null],
        ]);
    }
}
