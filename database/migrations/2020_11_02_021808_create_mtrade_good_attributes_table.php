<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeGoodAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_good_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_category_good_id');
            $table->string('name', 45);
            $table->integer('unit_id');
            $table->decimal('weight', 20, 2)->nullable();
            $table->string('tags', 255)->nullable();
            $table->timestamps();

            $table->foreign('mtrade_category_good_id')->references('id')->on('mtrade_category_goods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_good_attributes');
    }
}
