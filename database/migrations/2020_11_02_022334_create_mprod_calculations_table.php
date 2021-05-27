<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMprodCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mprod_calculations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_product_id');
            $table->unsignedBigInteger('mtrade_good_id');
            $table->decimal('amount', 20, 2);
            $table->timestamps();

            $table->foreign('primary_product_id')->references('id')->on('mprod_primary_products');
            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mprod_calculations');
    }
}
