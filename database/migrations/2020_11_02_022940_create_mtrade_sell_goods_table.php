<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeSellGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_sell_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_id');
            $table->unsignedBigInteger('mtrade_sell_good_consignment_id');
            $table->unsignedBigInteger('money_id');
            $table->decimal('amount', 20, 2);
            $table->decimal('cost', 20, 2);
            $table->integer('discount')->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();

            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
            $table->foreign('mtrade_sell_good_consignment_id')->references('id')->on('mtrade_sell_good_consignments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_sell_goods');
    }
}
