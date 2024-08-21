<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_types')->insert([
            ['id' => 1, 'name' => 'End User'],
            ['id' => 2, 'name' => 'Dropship'],
        ]);
    }
}
