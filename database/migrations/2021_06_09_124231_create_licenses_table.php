<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {




      







        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('dl_number')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('issued_date');
            $table->string('expiry_date')->nullable();
            $table->string('birth_date');
            $table->string('state');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('foot');
            $table->string('inches');
            $table->string('weight');
            $table->string('gender');
            $table->string('eye_color');
            $table->string('hair_color');
            $table->string('view');
            $table->string('picture')->nullable();
            $table->string('background')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('licenses');
    }
}
