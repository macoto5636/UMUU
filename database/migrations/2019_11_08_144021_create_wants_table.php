<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWantsTable extends Migration
{
    /**
     * Run the migrations.
     * 欲しいもの表
     * @return void
     */
    public function up()
    {
        Schema::create('wants', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');

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
        Schema::dropIfExists('wants');
    }
}
