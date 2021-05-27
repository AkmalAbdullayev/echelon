<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_customer_id');
            $table->integer('city_id');
            $table->string('address', 255)->nullable();
            $table->timestamps();

            $table->foreign('mtrade_customer_id')->references('id')->on('mtrade_customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_customer_addresses');
    }
}
