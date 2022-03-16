<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserIdAndCompanyIdOfMessageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_info', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->change();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->change();
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
            $table->dropForeign('message_info_company_id_foreign');
            $table->dropForeign('message_info_user_id_foreign');
        });
    }
}
