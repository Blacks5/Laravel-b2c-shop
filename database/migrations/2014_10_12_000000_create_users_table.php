<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('img')->default('images/getAvatar.do.jpg');
            $table->string('nick_name')->nullable();
            $table->integer('sex')->nullable();
            $table->integer('bron_year')->nullable();
            $table->integer('bron_m')->nullbale();
            $table->integer('bron_d')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('activated')->dufault(0);
            $table->string('emailToken');
            $table->integer('type')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
