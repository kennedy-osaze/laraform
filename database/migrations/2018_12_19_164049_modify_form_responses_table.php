<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFormResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_responses', function (Blueprint $table) {
            $table->dropForeign(['form_field_id']);
            $table->dropColumn(['form_field_id', 'answer']);

            $table->string('response_code', 64)->after('form_id');
            $table->ipAddress('respondent_ip')->after('response_code');
            $table->string('respondent_user_agent', 511)->after('respondent_ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_responses', function (Blueprint $table) {
            $table->dropColumn(['response_code', 'respondent_ip', 'respondent_user_agent']);

            $table->unsignedInteger('form_field_id')->after('form_id');
            $table->foreign('form_field_id')->references('id')->on('form_fields')->onDelete('cascade');
            $table->text('answer')->nullable()->after('form_field_id');
        });
    }
}
