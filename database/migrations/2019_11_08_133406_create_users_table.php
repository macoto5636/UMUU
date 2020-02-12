<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * ユーザ表作成
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->string('email',256)->unique();
            $table->string('password',256);
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->string('kana_first_name',50);
            $table->string('kana_last_name',50);
            $table->unsignedInteger('postalcode')->nullable();;
            $table->string('prefecture',5)->nullable();;
            $table->string('adress',256)->nullable();;
            $table->unsignedInteger('gender_id')->nullable();
            $table->unsignedBigInteger('tel')->nullable();
            $table->unsignedInteger('role_id');     
            $table->timestamps();   

            //外部キー制約
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
