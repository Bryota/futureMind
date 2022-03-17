<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditColumnsOrderOfMessageInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_info', function (Blueprint $table) {
            DB::statement("ALTER TABLE message_info MODIFY COLUMN room_id bigint unsigned NOT NULL AFTER id");
            DB::statement("ALTER TABLE message_info MODIFY COLUMN user_id bigint unsigned DEFAULT NULL AFTER room_id");
            DB::statement("ALTER TABLE message_info MODIFY COLUMN company_id bigint unsigned DEFAULT NULL AFTER user_id");
            DB::statement("ALTER TABLE message_info MODIFY COLUMN message_num int DEFAULT NULL AFTER company_id");
            DB::statement("ALTER TABLE message_info MODIFY COLUMN checked_status tinyint(1) NOT NULL AFTER message_num");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_info', function (Blueprint $table) {
            //
        });
    }
}
