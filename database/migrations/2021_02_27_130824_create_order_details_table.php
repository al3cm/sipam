<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('garment_price',8,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->double('discount',8,2)->nullable()->default(0);
            $table->double('subtotal',8,2)->default(0);
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('garment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
