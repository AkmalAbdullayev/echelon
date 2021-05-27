<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovePrimaryProductConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_primary_product_consignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mprod_primary_product_id');
            $table->unsignedBigInteger('warehouse_from');
            $table->unsignedBigInteger('warehouse_to');
            $table->decimal('amount', 20, 2);
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('mprod_primary_product_id', 'mprod_primary_product_id_8678')->references('id')->on('mprod_primary_products');
            $table->foreign('warehouse_from')->references('id')->on('warehouses');
            $table->foreign('warehouse_to')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('move_primary_product_consignments');
    }
}
