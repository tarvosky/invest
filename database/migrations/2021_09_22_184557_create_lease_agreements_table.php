<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_agreements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('landlord_first_name');
            $table->string('landlord_last_name');
            $table->string('form_date')->nullable();
            $table->mediumText('street');
            $table->string('city');
            $table->string('zip');
            $table->string('state');
            $table->string('month');
            $table->string('beginning_date');
            $table->string('county');
            $table->string('amount');
            $table->string('tenant_signature');
            $table->string('landlord_signature');
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
        Schema::dropIfExists('lease_agreements');
    }
}
