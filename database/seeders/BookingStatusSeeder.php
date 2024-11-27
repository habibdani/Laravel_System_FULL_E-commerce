<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('booking_status')->insert([
            ['id' => 1, 'name' => 'Order Receipt', 'color_status' => '#FFD700'],
            ['id' => 2, 'name' => 'Paid', 'color_status' => '#32CD32'],
            ['id' => 3, 'name' => 'Ship', 'color_status' => '#1E90FF'],
            ['id' => 4, 'name' => 'Confirmed', 'color_status' => '#008000'],
            ['id' => 5, 'name' => 'Delivered', 'color_status' => '#4B0082'],
            ['id' => 6, 'name' => 'Unpaid', 'color_status' => '#FFA500'],
            ['id' => 7, 'name' => 'Reject', 'color_status' => '#FF4500'],
        ]);
    }
}
