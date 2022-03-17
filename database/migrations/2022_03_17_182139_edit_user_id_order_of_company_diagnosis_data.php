<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditUserIdOrderOfCompanyDiagnosisData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_diagnosis_data', function (Blueprint $table) {
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN company_id bigint unsigned NOT NULL AFTER id");
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN developmentvalue int NOT NULL AFTER company_id");
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN socialvalue int NOT NULL AFTER developmentvalue");
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN stablevalue int NOT NULL AFTER socialvalue");
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN teammatevalue int NOT NULL AFTER stablevalue");
            DB::statement("ALTER TABLE company_diagnosis_data MODIFY COLUMN futurevalue int NOT NULL AFTER teammatevalue");
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
            //
        });
    }
}
