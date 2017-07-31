<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('tid');
            $table->string('title');
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('content');
            $table->string('url')->index();
            $table->string('source')->nullable();
            $table->boolean('enable')->default(1);
            $table->smallInteger('click')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        //article type
        Schema::create('articleType',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('pid')->default(0);
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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('articleType');
    }
}
