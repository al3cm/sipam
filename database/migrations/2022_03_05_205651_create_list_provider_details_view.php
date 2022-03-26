<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListProviderDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               
        DB::statement("CREATE OR REPLACE VIEW view_list_provider_details AS
        SELECT 
                pd.id,
                pd.process_id,
                pd.provider_id,
                pv.business_name,
                pd.service,
                pd.description,
                pd.cost
        FROM sipam.provider_details pd
        INNER JOIN sipam.providers pv ON pd.provider_id = pv.id
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_provider_details;");
    }
}
