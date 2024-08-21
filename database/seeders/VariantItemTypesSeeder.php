<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantItemTypesSeeder extends Seeder
{
    public function run()
    {
        $variantItemTypes = [
            ['id' => 1, 'name' => 'Ukuran'],
            ['id' => 2, 'name' => 'Tebal'],
        ];

        DB::table('variant_item_types')->insert($variantItemTypes);
    }
}
