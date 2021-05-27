<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeMoneyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_money_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_money_from_id');
            $table->unsignedBigInteger('mtrade_money_to_id');
            $table->decimal('rate', 20, 2);
            $table->dateTime('date');
            $table->timestamps();

            $table->foreign('mtrade_money_from_id')->references('id')->on('mtrade_money');
            $table->foreign('mtrade_money_to_id')->references('id')->on('mtrade_money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_money_rates');
    }
}
