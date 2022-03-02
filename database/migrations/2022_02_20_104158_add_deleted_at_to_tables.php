<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
        Schema::table('garments', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
        Schema::table('materials', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
        Schema::table('supplies', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
        Schema::table('types_garments', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('garments', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('supplies', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('types_garments', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
