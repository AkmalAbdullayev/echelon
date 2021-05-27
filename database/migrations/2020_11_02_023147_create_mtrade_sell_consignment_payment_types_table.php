<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtradeSellConsignmentPaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrade_sell_consignment_payment_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mtrade_sell_good_consignment_id');
            $table->unsignedBigInteger('mtrade_payment_type_id');
            $table->decimal('amount', 20, 2);
            $table->timestamps();

            $table->foreign('mtrade_sell_good_consignment_id', 'mtrade_sell_good_consignment_id_34565')->references('id')->on('mtrade_sell_good_consignments');
            $table->foreign('mtrade_payment_type_id', 'mtrade_payment_type_id_87678')->references('id')->on('mtrade_payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtrade_sell_consignment_payment_types');
    }
}
