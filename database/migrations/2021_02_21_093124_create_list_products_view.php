<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListProductsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               
        DB::statement("CREATE OR REPLACE VIEW view_list_products AS
        SELECT 
            g.id id,
            CONCAT(tg.description,', ',g.gender,', talla ',s.description,', color ',c.name,', hecho de ',m.name) garment_description,
            g.price
        FROM garments g
        INNER JOIN types_garments tg ON g.type_garment_id = tg.id
        INNER JOIN sizes s ON g.size_id=s.id
        INNER JOIN colors c ON g.color_id=c.id
        INNER JOIN materials m ON g.material_id=m.id
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_products;");
    }

}
