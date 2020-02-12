<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     * 支払表
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->string('payment_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
