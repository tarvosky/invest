<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoidchecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voidchecks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('routing_no');
            $table->string('check_no');
            $table->string('account_no');
            $table->string('voidlogo')->nullable();
            $table->string('logo')->nullable();
            $table->string('background')->nullable();
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
        Schema::dropIfExists('voidchecks');
    }
}
