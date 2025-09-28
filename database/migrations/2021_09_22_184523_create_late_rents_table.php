<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('late_rents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('landlord_first_name');
            $table->string('landlord_last_name');
            $table->string('form_date');
            $table->mediumText('street');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
            $table->string('month');
            $table->string('rent_fee');
            $table->string('late_fee');
            $table->string('account_number');
            $table->string('routing_number');
            $table->string('bank_name');
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
        Schema::dropIfExists('late_rents');
    }
}
