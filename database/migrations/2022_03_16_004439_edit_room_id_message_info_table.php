<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditRoomIdMessageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_info', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned()->change();
            $table->foreign('room_id')->references('id')->on('chat_rooms')->onDelete('cascade');
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
            $table->dropForeign('message_info_room_id_foreign');
        });
    }
}
