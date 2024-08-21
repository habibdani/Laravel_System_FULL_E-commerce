<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            [
                'id' => 1,
                'name' => 'Diambil di Gudang',
                'price_discount_percentage' => 1,
                'created_at' => '2024-03-27 16:15:23',
                'updated_at' => null,
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Dikirim',
                'price_discount_percentage' => null,
                'created_at' => '2024-03-27 16:15:23',
                'updated_at' => null,
                'deleted_at' => null,
            ]
        ]);
    }
}
