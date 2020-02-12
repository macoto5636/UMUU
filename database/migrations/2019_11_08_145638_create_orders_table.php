<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * 注文表
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('shipping_id');
            $table->timestamps();

            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('orderstates')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
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
