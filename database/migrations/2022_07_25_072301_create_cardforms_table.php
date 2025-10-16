<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardforms', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('form_id');
            $table->string('category');
            $table->string('near_station');
            $table->string('pickup_station');
            $table->string('to_route1');
            $table->string('from_route1');
            $table->string('to_route2');
            $table->string('from_route2');
            $table->string('to_route3');
            $table->string('from_route3');
            $table->string('name');
            $table->string('cnic');
            $table->string('cnic_expiry_date');
            $table->string('gender');
            $table->string('dob');
            $table->string('phone_number')->unique();
            $table->string('org_name');
            $table->string('faddress');
            $table->string('cnic_front');
            $table->string('cnic_back');
            $table->string('photo');
            $table->string('student_id_card_front');
            $table->string('student_id_card_back');
            $table->string('student_affidavite');
            $table->string('empolyee_affidavite');
            $table->string('empolyee_card');
            $table->string('disability_certificate');
            $table->string('pcrdp');
            $table->string('verify_form'); 
            $table->string('remarks'); 
            $table->string('cardnumber'); 
            $table->string('cardissuedate'); 
            $table->string('dispatch');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('cardforms');
    }
};
