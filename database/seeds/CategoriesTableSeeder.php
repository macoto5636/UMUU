<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *カテゴリ表のシーダ
     * @return void
     */
    public function run()
    {
        //カテゴリ表   下は例
        DB::table('categories')->insert([
            'category_name' => '美容サプリ'
        ]);

        DB::table('categories')->insert([
            'category_name' => '健康サプリ'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'ダイエットサプリ'
        ]);

        
        DB::table('categories')->insert([
            'category_name' => 'スムージー'
        ]);

        DB::table('categories')->insert([
            'category_name' => '酵素'
        ]);

        DB::table('categories')->insert([
            'category_name' => '雑炊'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'クッキー'
        ]);
    }
}
