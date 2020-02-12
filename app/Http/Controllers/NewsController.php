<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//モデル
use App\News;

class NewsController extends Controller
{
    //ニュースを全件表示
    public function index(Request $request){
        $news = \App\News::orderBy('created_at','desc')->get();
        return $news;
    }

    //ニュースを最初の３件だけ表示する
    public function take(Request $request){
        $news = \App\News::orderBy('created_at','desc')->take(3)->get();
        return $news;
    }

    //詳細を表示する
    public function details(Request $request){
        $items = \App\News::find($request->id);
        return $items;
    }

    //記事を投稿する
    public function create(Request $request){
        $news = new \App\News();
        $news -> title = request('title');
        $news -> article = request('text');
        $news -> created_at = now();

        $news -> save();
    }
}
