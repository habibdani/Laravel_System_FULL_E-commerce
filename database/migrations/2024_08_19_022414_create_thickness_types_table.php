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
        Schema::create('thickness_types', function (Blueprint $table) {
            $table->id();
            $table->decimal('thick', 4, 2);  // Kolom thick dengan tipe data decimal
            $table->unsignedBigInteger('product_variant_id');
            $table->timestamps();
            $table->softDeletes(); // Kolom deleted_at untuk soft delete

            // Foreign key constraint
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thickness_types');
    }
};
