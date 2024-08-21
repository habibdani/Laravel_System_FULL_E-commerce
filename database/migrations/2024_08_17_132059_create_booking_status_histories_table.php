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
        Schema::create('booking_status_histories', function (Blueprint $table) {
            $table->id(); // Use id() method for auto-incrementing primary key
            $table->integer('booking_id');
            $table->integer('booking_status_id');
            $table->timestamps(); // Automatically creates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_status_histories');
    }
};
