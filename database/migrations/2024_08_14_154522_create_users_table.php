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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ini secara otomatis menggunakan tipe bigIncrements
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('role_id'); // pastikan ini menggunakan tipe yang sama
            $table->timestamps();
            $table->softDeletes();

            // Menambahkan foreign key dengan referensi ke user_roles.id
            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
