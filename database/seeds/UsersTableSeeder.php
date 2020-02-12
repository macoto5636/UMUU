<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ユーザ関連の表のシーダー
     *      ・性別表
     *      ・ユーザ表
     *      ・クレジットカード表
     *
     * @return void
     */
    public function run()
    {
        
        //性別表
        DB::table('genders')->insert([
            'gender_name' => '男'
        ]);

        DB::table('genders')->insert([
            'gender_name' => '女'
        ]);

        DB::table('genders')->insert([
            'gender_name' => 'その他'
        ]);

        DB::table('roles')->insert([
            'role_name' => '顧客'
        ]);

        DB::table('roles')->insert([
            'role_name' => '管理者'
        ]);


        //ユーザ表
        DB::table('users')->insert([
            'email' => 'test@gmail.com',
            'password' => bcrypt('test'),
            'first_name' => '山田',
            'last_name' => '一郎',
            'kana_first_name' => 'ヤマダ',
            'kana_last_name' => 'イチロウ',
            'postalcode' => 1234567,
            'prefecture' => '北海道',
            'adress' => '札幌市1-1-1',
            'gender_id' => 1,
            'tel' => '222222222',
            'role_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'email' => 'test2@gmail.com',
            'password' => bcrypt('test2'),
            'first_name' => '田中',
            'last_name' => '花子',
            'kana_first_name' => 'タナカ',
            'kana_last_name' => 'ハナコ',
            'postalcode' => 9876543,
            'prefecture' => '大阪府',
            'adress' => '札幌市2-2-2',
            'gender_id' => 2,
            'tel' => '5555555',
            'role_id' => 1,
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'first_name' => '管理者',
            'last_name' => '太郎',
            'kana_first_name' => 'カンリシャ',
            'kana_last_name' => 'タロウ',
            'gender_id' => 1,
            'tel' => '5555555',
            'role_id' => 2,
            'created_at' => now(),
        ]);

        //クレジットカード表
        DB::table('creditcards')->insert([
            'number' => '0123456789',
            'security_code' => 012,
            'ex_mounth' => 1,
            'ex_year' => 2021,
            'name' => 'ICHIRO YAMADA',
            'user_id' => 1
        ]);

    }
}
