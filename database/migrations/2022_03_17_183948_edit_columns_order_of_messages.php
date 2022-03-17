<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditColumnsOrderOfMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            DB::statement("ALTER TABLE messages MODIFY COLUMN room_id bigint unsigned NOT NULL AFTER id");
            DB::statement("ALTER TABLE messages MODIFY COLUMN user_id bigint unsigned DEFAULT NULL AFTER room_id");
            DB::statement("ALTER TABLE messages MODIFY COLUMN company_id bigint unsigned DEFAULT NULL AFTER user_id");
            DB::statement("ALTER TABLE messages MODIFY COLUMN message varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL AFTER company_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
}
