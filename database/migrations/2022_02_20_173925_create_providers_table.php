<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruc',11)->nullable();
            $table->string('business_name',150);
            $table->tinyInteger('type');//1: Servicio 2: Insumo
            $table->string('address',100)->nullable();
            $table->string('phone',9)->nullable();
            $table->string('email',50)->nullable();
            $table->string('description',200)->nullable();
            $table->string('owner_dni',9)->nullable();
            $table->string('owner_name',150)->nullable();
            $table->string('contact_name',150)->nullable();
            $table->string('contact_phone',9)->nullable();
            $table->string('contact_email',50)->nullable();
            $table->string('bank',50)->nullable();
            $table->string('bank_account',20)->nullable();
            $table->boolean('state')->default(1);
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
        Schema::dropIfExists('providers');
    }
}
