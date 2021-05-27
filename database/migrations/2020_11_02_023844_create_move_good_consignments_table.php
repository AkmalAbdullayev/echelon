<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveGoodConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_good_consignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_id');
            $table->unsignedBigInteger('warehouse_from');
            $table->unsignedBigInteger('warehouse_to');
            $table->decimal('amount', 20, 2);
            $table->dateTime('date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
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
        Schema::dropIfExists('move_good_consignments');
    }
}
