<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     * 商品表
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            //カラム定義
            $table->increments('id');
            $table->unsignedInteger('category_id1');
            $table->string('product_name',50);
            $table->integer('price');
            $table->integer('stock');
            $table->text('product_details')->nullable();
            $table->text('component_details')->nullable();
            $table->string('image',256)->nullable();
            $table->integer('display')->default(1);
            $table->timestamps();

            //外部キー制約
            $table->foreign('category_id1')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
