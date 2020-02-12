<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     * 買い物かご表
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            //カラム定義
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->integer('number');

            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppings');
    }
}
