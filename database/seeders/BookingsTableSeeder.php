<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'id' => 1,
                'client_type_id' => 1,
                'client_name' => 'Hans',
                'client_phone_number' => 82123456574,
                'client_email' => 'hans@mail.com',
                'npwp' => null,
                'shipping_area_id' => 1,
                'address' => 'Jl. Kesehatan, No.25, Karang Ranji',
                'code_pos' => 44327,
                'created_at' => '2024-05-01 01:44:20',
                'updated_at' => null,
                'deleted_at' => null,
                'additional_price_percentage' => null,
                'commission_percentage' => null,
            ],
        ]);
    }
}
