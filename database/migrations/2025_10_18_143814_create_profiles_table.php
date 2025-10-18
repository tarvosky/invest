<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->enum('id_type', ['drivers_license','international_passport']);
            $table->string('id_front_path')->nullable(); // stored path
            $table->string('id_back_path')->nullable();  // optional for DL back
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
        Schema::dropIfExists('profiles');
    }
}
