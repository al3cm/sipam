<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('last_name',50);
            $table->string('second_last_name',50)->nullable();
            $table->string('document_type',30);
            $table->string('document_number',9);
            $table->string('ruc',11)->nullable();
            $table->string('business_name',150)->nullable();
            $table->string('person',20);
            $table->string('address',100)->nullable();
            $table->string('phone_number',9)->nullable();
            $table->string('email',50)->nullable();
            $table->boolean('state');
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
        Schema::dropIfExists('customers');
    }
}
