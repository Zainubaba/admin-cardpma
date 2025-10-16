<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_institutes', function (Blueprint $table) {
            $table->id();
             $table->string('user_id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('cnic');
            $table->string('email');
            $table->string('district');
            $table->string('tehsil');
            $table->string('institute_type');
            $table->string('edu_level');
            $table->string('hod_id');
            $table->string('emis')->unique();
            $table->string('org_name');

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
        Schema::dropIfExists('reg_institutes');
    }
}
