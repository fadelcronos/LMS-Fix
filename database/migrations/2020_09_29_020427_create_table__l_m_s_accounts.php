<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLMSAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LMS_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kpkNum')->unique();
            $table->string('fName');
            $table->string('email')->unique();
		    $table->string('image')->default('user.png');
            $table->string('pass');
            $table->string('level')->default('user');
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
        Schema::dropIfExists('table__l_m_s_accounts');
    }
}
