<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfDiagnosisDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('self_diagnosis_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('developmentvalue');
            $table->integer('socialvalue');
            $table->integer('stablevalue');
            $table->integer('teammatevalue');
            $table->integer('futurevalue');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('self_diagnosis_data');
    }
}
