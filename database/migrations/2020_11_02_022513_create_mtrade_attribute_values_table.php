<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_attribute_id');
            $table->unsignedBigInteger('mtrade_attribute_id');
            $table->string('value', 250);
            $table->timestamps();

            $table->foreign('mtrade_good_attribute_id')->references('id')->on('mtrade_good_attributes');
            $table->foreign('mtrade_attribute_id')->references('id')->on('mtrade_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_attribute_values');
    }
}
