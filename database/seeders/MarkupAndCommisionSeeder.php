<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkupAndCommisionSeeder extends Seeder
{
    public function run()
    {
        DB::table('markup_and_commisions')->insert([
            [
                'id' => 1,
                'additional_price_percentage' => 5,
                'commission_percentage' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'client_type_id' => 2,
            ],
        ]);
    }
}
