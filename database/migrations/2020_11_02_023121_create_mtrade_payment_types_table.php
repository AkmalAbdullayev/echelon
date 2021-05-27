<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradePaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_payment_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_money_id');
            $table->string('name', 45);
            $table->timestamps();

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
        Schema::dropIfExists('mtrade_payment_types');
    }
}
