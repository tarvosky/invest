<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */




    public function up()
    {
        Schema::create('wills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('law_firm_name');
            $table->string('law_firm_address');
            $table->string('law_firm_country');
            $table->string('testator');
            $table->string('testator_address');
            $table->string('lawyer');
            $table->string('dating_name');
            $table->string('dating_connection');
            $table->string('client_name');
            $table->string('client_connection');
            $table->string('amount');
            $table->string('currency');
            $table->text('property');
            $table->string('issued_date');
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
        Schema::dropIfExists('wills');
    }
}
