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
        Schema::create('booking_dropship_identities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booking_id');
            $table->longText('ktp_image')->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->bigInteger('bank_account_number')->nullable();
            $table->string('bank_account_holder_name', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_dropship_identities');
    }
};
