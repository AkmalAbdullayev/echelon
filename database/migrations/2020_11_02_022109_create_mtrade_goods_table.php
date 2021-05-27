<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_attribute_id');
            $table->string('sku', 45);
            $table->string('attributes', 150);
            $table->string('picture', 150)->nullable();
            $table->timestamps();
            $table->foreign('mtrade_good_attribute_id')
                ->references('id')
                ->on('mtrade_good_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_goods');
    }
}
