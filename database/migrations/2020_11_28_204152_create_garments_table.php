<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('price',8,2);
            $table->string('gender',10);
            $table->bigInteger('type_garment_id');
            $table->bigInteger('size_id');
            $table->bigInteger('color_id');
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
        Schema::dropIfExists('garments');
    }
}
