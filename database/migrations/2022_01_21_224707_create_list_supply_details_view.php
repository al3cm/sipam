<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListSupplyDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_list_supply_details AS
        SELECT
        sd.id,
        p.id process_id,
        s.id supply_id,
        CONCAT(s.description,', color ',c.name,', unidades en ',s.measure)supply,
        s.type,
        s.stock,
        sd.quantity
        FROM supply_details sd
        INNER JOIN processes p ON sd.process_id=p.id
        INNER JOIN supplies s ON sd.supply_id=s.id
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
        DB::statement("DROP VIEW IF EXISTS view_list_supply_details_view;");        
    }
}
