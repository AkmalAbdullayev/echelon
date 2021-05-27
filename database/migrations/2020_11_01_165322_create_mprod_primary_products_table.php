<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMprodPrimaryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mprod_primary_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_primary_product_id');
            $table->integer('unit_id');
            $table->string('name', 45);
            $table->string('sku', 45);
            $table->string('tags', 255)->nullable();
            $table->timestamps();

            $table->foreign('category_primary_product_id')->references('id')->on('mprod_category_primary_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mprod_primary_products');
    }
}
