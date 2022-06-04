<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('doc_type')->default(0);//0: Sin documento 1: Boleta 2: Factura
            $table->string('document',50)->nullable();
            $table->date('purchase_date');
            $table->double('total',8,2)->default(0);
            $table->boolean('state')->default(1);
            $table->bigInteger('provider_id')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
