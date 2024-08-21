<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatusHistorySeeder extends Seeder
{
    public function run()
    {
        DB::table('booking_status_histories')->insert([
            ['id' => 1, 'booking_id' => 1, 'booking_status_id' => 1, 'created_at' => '2024-05-01 02:29:50', 'updated_at' => null],
            ['id' => 2, 'booking_id' => 1, 'booking_status_id' => 2, 'created_at' => '2024-04-30 21:18:24', 'updated_at' => '2024-04-30 21:18:24'],
            ['id' => 3, 'booking_id' => 1, 'booking_status_id' => 3, 'created_at' => '2024-04-30 21:24:26', 'updated_at' => '2024-04-30 21:24:26'],
            ['id' => 4, 'booking_id' => 1, 'booking_status_id' => 1, 'created_at' => '2024-05-01 02:55:18', 'updated_at' => '2024-05-01 02:55:18'],
            ['id' => 5, 'booking_id' => 1, 'booking_status_id' => 2, 'created_at' => '2024-05-01 02:55:28', 'updated_at' => '2024-05-01 02:55:28'],
            ['id' => 6, 'booking_id' => 1, 'booking_status_id' => 3, 'created_at' => '2024-05-01 04:35:53', 'updated_at' => '2024-05-01 04:35:53'],
            ['id' => 7, 'booking_id' => 1, 'booking_status_id' => 2, 'created_at' => '2024-05-01 16:32:57', 'updated_at' => '2024-05-01 16:32:57'],
            ['id' => 8, 'booking_id' => 1, 'booking_status_id' => 3, 'created_at' => '2024-05-01 16:34:05', 'updated_at' => '2024-05-01 16:34:05'],
        ]);
    }
}
