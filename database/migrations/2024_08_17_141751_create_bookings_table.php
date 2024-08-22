<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_type_id')->nullable();
            $table->string('client_name');
            $table->bigInteger('client_phone_number');
            $table->string('client_email')->nullable();
            $table->bigInteger('npwp')->nullable();
            $table->integer('shipping_area_id');
            $table->string('address');
            $table->integer('code_pos');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('additional_price_percentage')->nullable();
            $table->integer('commission_percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
