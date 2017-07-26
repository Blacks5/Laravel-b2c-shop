<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->json('keywords');
            $table->text('description');
            $table->integer('price')->default(0);
            $table->integer('sale')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('saleNum')->default(0);
            $table->integer('type');
            $table->json('imgs');
            $table->boolean('show')->default(1);
            $table->boolean('recommend')->default(1);
            $table->text('content');
            $table->softDeletes();
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
        Schema::dropIfExists('goods');
    }
}
