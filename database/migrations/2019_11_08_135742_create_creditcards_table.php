<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditcardsTable extends Migration
{
    /**
     * Run the migrations.
     * クレジットカード表
     * @return void
     */
    public function up()
    {
        Schema::create('creditcards', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->unsignedBigInteger('number');
            $table->unsignedInteger('security_code');
            $table->unsignedInteger('ex_mounth');
            $table->unsignedInteger('ex_year');
            $table->string('name',50);
            $table->unsignedInteger('user_id');

            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditcards');
    }
}
