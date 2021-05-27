<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMprodUsedCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mprod_used_calculations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('production_id');
            $table->unsignedBigInteger('primary_product_id');
            $table->decimal('amount', 20, 2)->nullable();
            $table->timestamps();

            $table->foreign('production_id')->references('id')->on('mprod_productions');
            $table->foreign('primary_product_id')->references('id')->on('mprod_primary_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mprod_used_calculations');
    }
}
