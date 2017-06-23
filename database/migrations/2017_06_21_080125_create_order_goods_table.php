<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('oid');
            $table->integer('gid');
            $table->string('img');
            $table->string('name');
            $table->string('info')->nullable();
            $table->integer('sale');
            $table->integer('number');
            $table->integer('total');
            $table->integer('refund')->default(0);
            $table->integer('state')->default(0);
            $table->string('refund_type')->nullable();
            $table->string('refund_reason')->nullable();
            $table->integer('refund_price')->nullable();
            $table->string('refund_info')->nullable();
            $table->string('refund_img')->nullable();
            $table->string('refund_pay')->nullable();
            $table->integer('refund_number')->nullable();
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
        Schema::dropIfExists('order_goods');
    }
}
