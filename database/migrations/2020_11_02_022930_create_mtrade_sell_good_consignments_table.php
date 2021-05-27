<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeSellGoodConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_sell_good_consignments', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->tinyInteger('discount_type')->default(0);
            $table->decimal('discount', 20, 2)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('description', 255)->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('mtrade_customers');
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
        Schema::dropIfExists('mtrade_sell_good_consignments');
    }
}
