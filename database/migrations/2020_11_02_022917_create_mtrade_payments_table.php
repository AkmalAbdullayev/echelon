<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->unsignedBigInteger('mtrade_customer_id');
            $table->unsignedBigInteger('mtrade_money_id');
            $table->unsignedBigInteger('mtrade_money_to_id');
            $table->enum('type', ['get', 'pay']);
            $table->decimal('amount', 20, 2);
            $table->decimal('rate', 20, 2);
            $table->decimal('amount_to', 20, 2)->nullable();
            $table->string('description', 250)->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('mtrade_customer_id')->references('id')->on('mtrade_customers');
            $table->foreign('mtrade_money_id')->references('id')->on('mtrade_money');
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
        Schema::dropIfExists('mtrade_payments');
    }
}
