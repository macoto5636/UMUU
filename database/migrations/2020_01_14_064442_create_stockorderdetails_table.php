<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockorderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     * 入庫注文詳細表
     * @return void
     */
    public function up()
    {
        Schema::create('stockorderdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('stock_order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('number');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->foreign('stock_order_id')->references('id')->on('stockorders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockorderdetails');
    }
}
