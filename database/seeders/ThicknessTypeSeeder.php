<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ThicknessType;

class ThicknessTypeSeeder extends Seeder
{
    public function run()
    {
        $thicknesses = [0.20, 0.25, 0.30, 0.35, 0.40, 0.45, 0.50];
        $productVariantId = 1;

        foreach ($thicknesses as $thick) {
            ThicknessType::create([
                'thick' => $thick,
                'product_variant_id' => $productVariantId
            ]);
        }
    }
}
