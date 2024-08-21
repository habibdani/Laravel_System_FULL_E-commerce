<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSubdistrictSeeder extends Seeder
{
    public function run()
    {
        $subdistricts = [
            ['id' => 1, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:19:29', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Selong'],
            ['id' => 2, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Gunung'],
            ['id' => 3, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kramat Pela'],
            ['id' => 4, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Gandaria Utara'],
            ['id' => 5, 'shipping_district_id' => 25, 'price' => 150000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cipete Utara'],
            ['id' => 6, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Melawai'],
            ['id' => 7, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Pulo'],
            ['id' => 8, 'shipping_district_id' => 25, 'price' => 100000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Petogogan'],
            ['id' => 9, 'shipping_district_id' => 25, 'price' => 150000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Rawa Barat'],
            ['id' => 10, 'shipping_district_id' => 25, 'price' => 200000, 'created_at' => '2024-04-15 16:21:51', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Senayan'],
            ['id' => 11, 'shipping_district_id' => 26, 'price' => 100000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Grogol Utara'],
            ['id' => 12, 'shipping_district_id' => 26, 'price' => 100000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Grogol Selatan'],
            ['id' => 13, 'shipping_district_id' => 26, 'price' => 75000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cipulir'],
            ['id' => 14, 'shipping_district_id' => 26, 'price' => 100000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kebayoran Lama Selatan'],
            ['id' => 15, 'shipping_district_id' => 26, 'price' => 100000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kebayoran Lama Utara'],
            ['id' => 16, 'shipping_district_id' => 26, 'price' => 100000, 'created_at' => '2024-04-15 16:23:48', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Pondok Pinang'],
            ['id' => 17, 'shipping_district_id' => 28, 'price' => 150000, 'created_at' => '2024-04-15 16:25:40', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cipete Selatan'],
            ['id' => 18, 'shipping_district_id' => 28, 'price' => 150000, 'created_at' => '2024-04-15 16:25:40', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Gandaria Selatan'],
            ['id' => 19, 'shipping_district_id' => 28, 'price' => 150000, 'created_at' => '2024-04-15 16:25:40', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cilandak Barat'],
            ['id' => 20, 'shipping_district_id' => 28, 'price' => 100000, 'created_at' => '2024-04-15 16:25:40', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Lebak Bulus'],
            ['id' => 21, 'shipping_district_id' => 28, 'price' => 150000, 'created_at' => '2024-04-15 16:25:40', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Pondok Labu'],
            ['id' => 22, 'shipping_district_id' => 35, 'price' => 150000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cengkareng Barat'],
            ['id' => 23, 'shipping_district_id' => 35, 'price' => 150000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Cengkareng Timur'],
            ['id' => 24, 'shipping_district_id' => 35, 'price' => 100000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Duri Kosambi'],
            ['id' => 25, 'shipping_district_id' => 35, 'price' => 200000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kapuk'],
            ['id' => 26, 'shipping_district_id' => 35, 'price' => 150000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kedaung Kaliangke'],
            ['id' => 27, 'shipping_district_id' => 35, 'price' => 150000, 'created_at' => '2024-04-15 16:27:27', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Rawa Buaya'],
            ['id' => 28, 'shipping_district_id' => 37, 'price' => 150000, 'created_at' => '2024-04-15 16:29:20', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Pegadungan'],
            ['id' => 29, 'shipping_district_id' => 37, 'price' => 150000, 'created_at' => '2024-04-15 16:29:20', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kalideres'],
            ['id' => 30, 'shipping_district_id' => 37, 'price' => 200000, 'created_at' => '2024-04-15 16:29:20', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kamal'],
            ['id' => 31, 'shipping_district_id' => 37, 'price' => 100000, 'created_at' => '2024-04-15 16:29:20', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Semanan'],
            ['id' => 32, 'shipping_district_id' => 37, 'price' => 200000, 'created_at' => '2024-04-15 16:29:20', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Tegal Alur'],
            ['id' => 33, 'shipping_district_id' => 39, 'price' => 75000, 'created_at' => '2024-04-15 16:31:16', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Srengseng'],
            ['id' => 34, 'shipping_district_id' => 39, 'price' => 100000, 'created_at' => '2024-04-15 16:31:16', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kembangan Barat'],
            ['id' => 35, 'shipping_district_id' => 39, 'price' => 100000, 'created_at' => '2024-04-15 16:31:16', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Kembangan Timur'],
            ['id' => 36, 'shipping_district_id' => 39, 'price' => 75000, 'created_at' => '2024-04-15 16:31:16', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Meruya Utara'],
            ['id' => 37, 'shipping_district_id' => 39, 'price' => 75000, 'created_at' => '2024-04-15 16:31:16', 'updated_at' => null, 'deleted_at' => null, 'name' => 'Meruya Selatan'],
        ];

        DB::table('shipping_subdistricts')->insert($subdistricts);
    }
}
