<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCmsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_users', function (Blueprint $table) {
            $table->double('salary',8,2)->nullable()->after('status');
            $table->string('address',100)->nullable()->after('status');
            $table->string('personal_email',50)->nullable()->after('status');
            $table->string('phone',9)->nullable()->after('status');
            $table->tinyInteger('gender')->nullable()->after('status');//1: Masculino 2: Femenino 3: Otro
            $table->string('nacionality',20)->nullable()->after('status');
            $table->date('dob')->nullable()->after('status');
            $table->string('id_number',9)->nullable()->after('status');
            $table->tinyInteger('id_type')->nullable()->after('status');//1: DNI 2: C.E.

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_users', function (Blueprint $table) {
            $table->dropColumn('salary');
            $table->dropColumn('address');
            $table->dropColumn('personal_email');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
            $table->dropColumn('nacionality');
            $table->dropColumn('dob');
            $table->dropColumn('document_number');
            $table->dropColumn('id_type');
        });
    }
}
