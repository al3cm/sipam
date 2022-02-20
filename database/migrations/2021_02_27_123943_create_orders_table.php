<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('order_number',10)->unique();
            $table->tinyInteger('type');//1: Proforma 2: Pedido
            $table->date('order_date');
            $table->date('delivery_date');
            $table->double('subtotal',8,2)->default(0);
            $table->double('tax',8,2)->nullable();
            $table->double('total',8,2)->default(0);
            $table->double('advance_payment',8,2)->nullable()->default(0);
            $table->double('pending_payment',8,2)->nullable()->default(0);
            $table->tinyInteger('state')->default(1);//0:Inactivo/Anulado 1: Registrado 2: En proceso 3: Proceso finalizado 4: Pedido finalizado 
            $table->bigInteger('customer_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
