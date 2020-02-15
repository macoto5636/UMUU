<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//問い合わせ送信
 Route::post('/inquiry/send', 'MailController@inquirySend');

//ログイン周り
Route::post('/login', 'AuthController@login');
 
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'api'], function(){
    //パスワードを忘れた場合
    Route::post('/pass/forget', 'AuthController@forget');
    //パスワード再設定メール送信
    Route::post('/mail', 'MailController@mailSend');
    //パスワード再設定
    Route::post('/pass/resetting', 'AuthController@passUpdate');    

    //ユーザ表
    //ユーザを登録する処理(新規登録)
    Route::post('/user/create',function(){
        //リクエストデータを元にユーザを登録
        $user = new App\User();
        $user -> email = request('email');
        $user -> password = bcrypt(request('password'));
        $user -> first_name = request('firstname');
        $user -> last_name = request('lastname');
        $user -> kana_first_name = request('kana_firstname');
        $user -> kana_last_name = request('kana_lastname');
        $user -> postalcode = request('postalcode');
        $user -> prefecture = request('prefecture');
        $user -> adress = request('adress');
        $user -> role_id = request('role_id');

        $user -> save();
        
    });

    //ニュース表
    //ニュースを表示する処理
    Route::get('newses','NewsController@index');

    //ニュースを最初の3件だけ表示する処理
    Route::get('newses/take','NewsController@take');

    //記事を投稿する処理
    Route::post('newses/create','NewsController@create');

    //詳細表示
    Route::get('newses/{id}','NewsController@details');
    // Route::resource('news', 'NewsController', only[]);

    //カテゴリ表
    //カテゴリ取得
    Route::get('category/index','CategoryController@index'); 
    //商品表
    //商品全件取得
    Route::get('products/get','ProductSearchController@get'); 
    Route::get('products/getdisplay','ProductSearchController@getDisplay'); 

    ////検索欄で入力されたキーワードを使用し商品データを抽出
    Route::post('products/search',  'ProductSearchController@search'); 

    Route::post('products/category' , 'ProductSearchController@category');

    ////関連商品抽出(現在は商品表から６件取得するだけ)
    Route::get('products/relation', 'ProductSearchController@relation'); 

    //商品管理画面
    Route::get('products','ProductController@index');

    Route::post('products/update','ProductController@update');
    Route::post('products/insert','ProductController@insert');

    //詳細表示
    Route::get('products/{id}','ProductSearchController@details');
    
    //入庫
    Route::post('products/edit', 'ProductController@edit');

    //注文
    //注文全件取得
    Route::get('order/get','OrderController@index'); 
    Route::get('order/gets','OrderController@get');

    Route::get('order/getdetail/{id}','OrderController@getDetail');

    //注文状態変更
    Route::post('order/edit','OrderController@edit');
    //注文ユーザごと
    Route::get('order/user/{id}','OrderController@user'); 
    Route::get('order/user_detail/{id}','OrderController@user_detail'); 
    Route::get('order/user_shipping/{id}','OrderController@user_shipping'); 
    Route::get('order/user_state/{id}','OrderController@user_state');
    Route::get('order/order_product/{id}','OrderController@order_product');
    Route::get('order/index2','OrderController@index2'); 
    //注文登録
    Route::post('order/add','OrderController@add');
    Route::post('order/add_detail','OrderController@add_detail');

    //注文を日付絞る
    Route::post('order/nikkei','OrderController@nikkei'); 

    //カート
    Route::get('cart/user_get/{id}','CartController@user_get');
    Route::get('cart/product_get/{id}/{pro_id}','CartController@product_get');
    Route::get('cart/count/{id}','CartController@count');
    Route::delete('cart/delete/{id}','CartController@delete');
    Route::post('cart/add','CartController@add');
    Route::post('cart/edit','CartController@edit');

    //配送方法取得
    Route::get('order/shipping_get/{id}','OrderController@shipping_get');

    //欲しいもの
    //wants表からデータを取得
    Route::get('wants/user_get/{id}', 'WantsController@user_get');
    //wantsテーブルからデータを削除
    Route::delete('wants/delete/{id}', 'WantsController@delete');
    //追加
    Route::post('wants/add','WantsController@add');
    //チェック
    Route::get('wants/check/{user_id}/{product_id}','WantsController@check');

    //レビュー表からデータ取得
    Route::get('reviews/get/{id}', 'ReviewController@get_reviews');
    //レビュー表から平均を取得
    Route::get('reviews/get_avg/{id}', 'ReviewController@get_reviews_avg');

    //レビューの追加
    Route::post('reviews/send', 'ReviewController@received');

    //ユーザ確認でユーザの情報を取得
    Route::get('/user/Verification', 'AuthController@userGet');
    //ユーザ情報変更
    Route::post('/user/change', 'AuthController@userChange');


});