<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 注文関連のシーダ
     *      ・注文状態表
     *      ・支払表

     * @return void
     */
    public function run()
    {
        //注文状態表
        DB::table('orderstates')->insert([
            'state_name' => '入金待ち'
        ]);

        DB::table('orderstates')->insert([
            'state_name' => '発送待ち'
        ]);

        DB::table('orderstates')->insert([
            'state_name' => '発送済'
        ]);

        DB::table('orderstates')->insert([
            'state_name' => 'キャンセル'
        ]);
            
        //支払表
        DB::table('payments')->insert([
            'payment_name' => 'クレジットカード'
        ]);

        DB::table('payments')->insert([
            'payment_name' => 'コンビニ'
        ]);

        //発送表
        DB::table('shippings')->insert([
            'shipping_name' => '通常発送',
            'postage' => 500
        ]);

        DB::table('shippings')->insert([
            'shipping_name' => 'お急ぎ発送',
            'postage' => 800
        ]);

        DB::table('orders')->insert([
            'user_id' => 1,
            'state_id' => 1,
            'payment_id' => 1,
            'shipping_id' => 1,
            'created_at' => now()
        ]);

        DB::table('orderdetails')->insert([
            'order_id' => 1,
            'product_id' => 1,
            'number' => 3,
            'price' => 1500,
        ]);

        DB::table('orderdetails')->insert([
            'order_id' => 1,
            'product_id' => 2,
            'number' => 1,
            'price' => 900,
        ]);

        DB::table('orders')->insert([
            'user_id' => 1,
            'state_id' => 3,
            'payment_id' => 1,
            'shipping_id' => 1,
            'created_at' => now()
        ]);

        DB::table('orderdetails')->insert([
            'order_id' => 2,
            'product_id' => 4,
            'number' => 10,
            'price' => 15000,
        ]);

        DB::table('orderdetails')->insert([
            'order_id' => 2,
            'product_id' => 7,
            'number' => 3,
            'price' => 2100,
        ]);
        
    }
}
