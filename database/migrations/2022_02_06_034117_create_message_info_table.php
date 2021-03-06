<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->Integer('room_id');
            $table->Integer('company_user');
            $table->Integer('student_user');
            $table->Integer('message_num');
            $table->boolean('checked_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_info');
    }
}
