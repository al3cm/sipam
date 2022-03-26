<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListProvidersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               
        DB::statement("CREATE OR REPLACE VIEW view_list_providers AS
		SELECT
            pv.id,
            pv.ruc,
            pv.business_name,
            pv.description,
            pv.address,
            (SELECT COUNT(*) 
            FROM sipam.provider_details pd
            INNER JOIN sipam.processes p ON pd.process_id = p.id
            WHERE p.state=1 AND pd.provider_id=pv.id
            )processes
		FROM sipam.providers pv
		WHERE pv.state=1 AND pv.type=1
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_providers;");
    }
}
