<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaystubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('paystubs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company_name');
            $table->string('company_street');
            $table->string('company_city');
            $table->string('company_zip');
            $table->string('company_state');
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
            $table->string('type');
            $table->string('ssn');
            $table->string('pay_date');
            $table->string('pay_type');
            $table->string('annual_pay');
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
        Schema::dropIfExists('paystubs');
    }
}
