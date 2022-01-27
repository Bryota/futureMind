<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('companies', function (Blueprint $table) {
        $table->string('company_icon')->defalut('')->nullable();
        $table->string('industry')->defalut('')->nullable();
        $table->string('office')->defalut('')->nullable();
        $table->integer('employee')->defalut('')->nullable();
        $table->string('homepage')->defalut('')->nullable();
        $table->string('comment')->defalut('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
