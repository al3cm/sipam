<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaterialToGarments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garments', function (Blueprint $table) {
            $table->bigInteger('material_id')->after('color_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('garments', function (Blueprint $table) {
            $table->dropColumn('material_id');
        });
    }
}
