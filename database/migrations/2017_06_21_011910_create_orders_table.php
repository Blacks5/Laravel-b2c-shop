<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('order_number');
            $table->string('address');
            $table->string('name');
            $table->string('phone');
            $table->integer('postage');
            $table->integer('total');
            $table->integer('state')->default(1);
            $table->string('post_no')->nullable();
            $table->string('post_code')->nullable();
            $table->string('post_name')->nullable();
            $table->string('remake')->nullable();
            $table->integer('remind')->default(0);
            $table->string('pay_way')->default('支付宝');
            $table->integer('pay_number')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
