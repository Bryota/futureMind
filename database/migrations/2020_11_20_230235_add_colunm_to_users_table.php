<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('year')->defalut('')->nullable();
            $table->string('university')->defalut('')->nullable();
            $table->string('hobby')->defalut('')->nullable();
            $table->string('club')->defalut('')->nullable();
            $table->string('industry')->defalut('')->nullable();
            $table->string('hometown')->defalut('')->nullable();
            $table->string('img_name')->defalut('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
