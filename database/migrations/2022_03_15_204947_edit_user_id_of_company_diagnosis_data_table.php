<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserIdOfCompanyDiagnosisDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_diagnosis_data', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->change();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_diagnosis_data', function (Blueprint $table) {
            $table->dropForeign('company_diagnosis_data_company_id_foreign');
        });
    }
}
