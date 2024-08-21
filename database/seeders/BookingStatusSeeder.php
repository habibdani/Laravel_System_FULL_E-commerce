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
            ['id' => 1, 'name' => 'Order Receipt'],
            ['id' => 2, 'name' => 'Paid'],
            ['id' => 3, 'name' => 'Ship'],
        ]);
    }
}
