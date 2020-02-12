<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     * カテゴリ表
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->string('category_name');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
