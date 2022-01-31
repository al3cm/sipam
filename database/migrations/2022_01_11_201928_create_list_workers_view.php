<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListWorkersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW view_list_workers AS
            SELECT
            u.id,
            u.name username,
            p.name privilege
            FROM sipam.cms_users u
            INNER JOIN sipam.cms_privileges p ON u.id_cms_privileges=p.id
            WHERE u.status='Active' AND p.is_superadmin=0 AND p.id<>4
        ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_list_workers;");
    }
}
