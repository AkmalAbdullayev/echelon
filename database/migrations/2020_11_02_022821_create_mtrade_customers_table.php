<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->unsignedBigInteger('mtrade_money_id')->nullable();
            $table->string('name', 45);
            $table->string('last_name', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->decimal('left', 20, 2)->nullable();
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
        Schema::dropIfExists('mtrade_customers');
    }
}
