<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradePriceListHasGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_price_list_has_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_price_list_id');
            $table->unsignedBigInteger('mtrade_good_id');
            $table->unsignedBigInteger('mtrade_money_id');
            $table->decimal('cost', 20, 2);
            $table->timestamps();

            $table->foreign('mtrade_price_list_id')->references('id')->on('mtrade_price_lists');
            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
            $table->foreign('mtrade_money_id')->references('id')->on('mtrade_money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_price_list_has_goods');
    }
}
