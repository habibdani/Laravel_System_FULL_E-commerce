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
        Schema::create('markup_and_commisions', function (Blueprint $table) {
            $table->id(); // Use id() method for auto-incrementing primary key
            $table->integer('additional_price_percentage')->nullable();
            $table->integer('commission_percentage')->nullable();
            $table->timestamps();
            $table->integer('client_type_id'); // Assuming this is a foreign key; add constraints if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markup_and_commisions');
    }
};
