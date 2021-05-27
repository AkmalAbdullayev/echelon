<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_category_expense_id');
            $table->unsignedBigInteger('money_id');
            $table->string('name', 150);
            $table->decimal('cost', 20, 2);
            $table->decimal('amount', 20, 2);
            $table->date('date');
            $table->timestamps();

            $table->foreign('mtrade_category_expense_id')->references('id')->on('mtrade_category_expenses');
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
        Schema::dropIfExists('mtrade_expenses');
    }
}
