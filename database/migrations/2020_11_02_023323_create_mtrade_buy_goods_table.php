<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeBuyGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_buy_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_id');
            $table->unsignedBigInteger('mtrade_buy_good_consignment_id');
            $table->unsignedBigInteger('money_id');
            $table->decimal('amount', 20, 2);
            $table->decimal('cost', 20, 2);
            $table->date('date');
            $table->string('description', 255);
            $table->timestamps();

            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
            $table->foreign('mtrade_buy_good_consignment_id')->references('id')->on('mtrade_buy_good_consignments');
            $table->foreign('money_id')->references('id')->on('mtrade_money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_buy_goods');
    }
}
