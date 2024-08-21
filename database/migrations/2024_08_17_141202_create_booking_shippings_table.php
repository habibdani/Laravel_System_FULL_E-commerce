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
        Schema::create('booking_shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booking_id')->nullable();
            $table->unsignedInteger('shipping_id')->nullable();
            $table->integer('price')->nullable();
            $table->unsignedInteger('shipping_district_id')->nullable();
            $table->unsignedInteger('shipping_subdistrict_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_shippings');
    }
};
