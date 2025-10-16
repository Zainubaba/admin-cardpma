<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('card_type');
            $table->string('district');
            $table->string('tehsil');
            $table->string('system_name');
            $table->string('stop_name');
            $table->string('station_name');
            $table->string('institute_type');
            $table->string('edu_level');
            $table->string('org_name');
            $table->string('bop_branch');
            $table->string('start_year');
            $table->string('end_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_infos');
    }
}
