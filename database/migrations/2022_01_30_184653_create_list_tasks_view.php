<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_list_tasks AS
        SELECT
            t.id,
            p.id process_id,
            u.id user_id,  
            u.name responsable,
            t.title,
            t.description,
            t.check finished,
            t.finish_date
        FROM sipam.tasks t
        INNER JOIN processes p ON p.id=t.process_id
        INNER JOIN sipam.cms_users u ON u.id=t.user_id
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_tasks;");        
    }
}
