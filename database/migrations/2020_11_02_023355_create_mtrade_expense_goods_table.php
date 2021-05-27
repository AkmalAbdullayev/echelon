<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeExpenseGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_expense_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_good_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->decimal('amount', 20, 2);
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('mtrade_good_id')->references('id')->on('mtrade_goods');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_expense_goods');
    }
}
