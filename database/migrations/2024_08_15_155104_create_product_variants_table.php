<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->integer('price');
            $table->mediumText('descriptions')->nullable();
            $table->tinyInteger('po_status')->default(0);
            $table->foreignId('product_id')->constrained('products');
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->longText('image')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
