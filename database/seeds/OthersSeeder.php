<?php

use Illuminate\Database\Seeder;

class OthersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ニュース表
        DB::table('newses')->insert([
            'title' => '新着商品を入荷しました！',
            'article' =>  '本日、新着商品を入荷しました！入荷した商品はこちら！',
            'created_at' => now()
        ]);

        DB::table('newses')->insert([
            'title' => '閉店のお知らせ',
            'article' =>  '本日まことに悲しいお知らせがございます。平素より',
            'created_at' => now()
        ]);
    }
}
