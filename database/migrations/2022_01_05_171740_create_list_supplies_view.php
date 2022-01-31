<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListSuppliesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               
        DB::statement("CREATE OR REPLACE VIEW view_list_supplies AS
        SELECT
        s.id,
        CONCAT(s.description,', color ',c.name,', unidades en ',s.measure)supply,
        s.type,
        s.stock
        FROM supplies s
        INNER JOIN colors c ON s.color_id=c.id
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_supplies;");
    }
}
