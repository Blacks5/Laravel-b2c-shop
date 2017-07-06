<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('width');
            $table->integer('height');
            $table->string('type');
            $table->text('desc')->nullable();
            $table->timestamps();
        });

        Schema::create('ad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id');
            $table->integer('type')->default(0);
            $table->string('name');
            $table->string('link');
            $table->text('code');
            $table->integer('start_time')->default(0);
            $table->integer('end_time')->default(0);
            $table->integer('count')->default(0);
            $table->tinyInteger('enable')->default(1);
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
        Schema::dropIfExists('positions');
        Schema::dropIfExists('ad');
    }
}
