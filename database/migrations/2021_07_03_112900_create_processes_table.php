<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->date('deadline');
            $table->date('finish_date')->nullable();
            $table->integer('batch');
            $table->integer('cutting_batch')->default(0);
            $table->integer('enabled_batch')->default(0);
            $table->integer('confection_batch')->default(0);
            $table->integer('finishing_batch')->default(0);
            $table->double('advance',8,2)->default(0);
            $table->string('notes',500);
            $table->tinyInteger('state')->default(1);//0:Inactivo/Anulado 1: En proceso 2: Finalizado 
            $table->bigInteger('order_id');
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
        Schema::dropIfExists('processes');
    }
}
