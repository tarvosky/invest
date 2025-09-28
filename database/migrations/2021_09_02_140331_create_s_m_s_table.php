<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('s_m_s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('number')->nullable();
            $table->string('country')->nullable();
            $table->string('code')->nullable();
            $table->string('website')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('sms_services_id');
            $table->foreign('sms_services_id')->references('id')->on('sms_services')->onDelete('cascade'); 
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
        Schema::dropIfExists('s_m_s');
    }
}
