<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListPurchaseDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_list_purchase_details AS
        SELECT
        pd.id,
        p.id purchase_id,
        s.id supply_id,
        CONCAT(s.description,', color ',c.name,', unidades en ',s.measure)supply,
        s.type,
        s.stock,
        pd.quantity,
        pd.price,
        pd.subtotal
        FROM purchase_details pd
        INNER JOIN purchases p ON pd.purchase_id=p.id
        INNER JOIN supplies s ON pd.supply_id=s.id
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
        DB::statement("DROP VIEW IF EXISTS view_list_purchase_details;");        
    }
}
