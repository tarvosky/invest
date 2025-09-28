<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyDetailsToVoidchecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voidchecks', function (Blueprint $table) {
            $table->dropColumn('voidlogo')->nullable();
            $table->dropColumn('check_no');
            $table->string('company_name');
            $table->string('company_street');
            $table->string('company_city');
            $table->string('company_zip');
            $table->string('company_state');
            $table->string('bank_name');
            $table->string('bank_street');
            $table->string('bank_city');
            $table->string('bank_zip');
            $table->string('bank_state');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voidchecks', function (Blueprint $table) {
            $table->dropColumn('company_company_name');
            $table->dropColumn('company_street');
            $table->dropColumn('company_city');
            $table->dropColumn('company_zip');
            $table->dropColumn('company_state');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_street');
            $table->dropColumn('bank_city');
            $table->dropColumn('bank_zip');
            $table->dropColumn('bank_state');
            $table->dropColumn('type');
        });
    }
}
