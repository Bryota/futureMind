<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserIdOfSelfDiagnosisDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('self_diagnosis_data', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('self_diagnosis_data', function (Blueprint $table) {
            $table->dropForeign('self_diagnosis_data_user_id_foreign');
        });
    }
}
