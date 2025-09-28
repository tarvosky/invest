<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('security');
            $table->string('security_value');
            $table->string('instruction_code');
            $table->string('full_name');
            $table->string('business_name');
            $table->string('business_description');
            $table->string('state');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('year');
            $table->string('total_income');
            $table->string('total_expenses');
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
        Schema::dropIfExists('taxes');
    }
}
