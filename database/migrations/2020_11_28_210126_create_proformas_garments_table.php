<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformasGarmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proformas_garments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->bigInteger('proforma_id')->nullable();
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
        Schema::dropIfExists('proformas_garments');
    }
}
