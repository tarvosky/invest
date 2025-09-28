<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEinlettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('einletters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company_name');      
            $table->string('ein_issued_date');
            $table->string('ein');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
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
        Schema::dropIfExists('einletters');
    }
}
