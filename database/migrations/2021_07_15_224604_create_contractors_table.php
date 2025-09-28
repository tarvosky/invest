<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('year');
            $table->string('employers_business_name');
            $table->string('employers_phone');
            $table->string('employers_street');
            $table->string('employers_city');
            $table->string('employers_state');
            $table->string('employers_zip');
            $table->string('employers_ein');
            $table->string('applicant_fullname');
            $table->string('applicant_street');
            $table->string('applicant_city');
            $table->string('applicant_state');
            $table->string('applicant_zip');
            $table->string('applicant_ssn');
            $table->string('applicant_total_income'); 
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('contractors');
    }
}
