<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sessions')->insert([
            'id' => 'zh6ubNAnGo1p0NTpLXnmNUsOiE5hOBOB5B7hi19w',
            'user_id' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWxqY1pFNkVZOWVKS29aRzdvVzlSSTVSWmJNYXNvVU9xeEV4alZvSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9vcmRlcnMvb3JkZXItbGlzdCI7fX0=',
            'last_activity' => 1714606614,
            'deleted_at' => null,
        ]);
    }
}
