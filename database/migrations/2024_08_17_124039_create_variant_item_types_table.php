<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('variant_item_types', function (Blueprint $table) {
            $table->id(); // ini akan menggunakan `bigint` sebagai default
            $table->string('name', 100)->nullable();
            $table->timestamps(); // ini akan menambahkan `created_at` dan `updated_at`
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_item_types');
    }
};
