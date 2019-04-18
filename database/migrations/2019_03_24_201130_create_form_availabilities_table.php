<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id');
            $table->dateTime('open_form_at')->nullable();
            $table->dateTime('close_form_at')->nullable();
            $table->unsignedInteger('response_count_limit')->nullable();
            $table->unsignedTinyInteger('available_weekday')->nullable();
            $table->time('available_start_time')->nullable();
            $table->time('available_end_time')->nullable();
            $table->text('closed_form_message')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('form_availabilities', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_availabilities');
    }
}
