<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderstatesTable extends Migration
{
    /**
     * Run the migrations.
     * 注文状態表
     * @return void
     */
    public function up()
    {
        Schema::create('orderstates', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->string('state_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderstates');
    }
}
