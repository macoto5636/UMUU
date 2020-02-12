<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function index(Request $request){
        return view('reviews.index');
    }

    public function display(Request $request){
        return view('reviews.display');
    }

    //レビューをデータベースに追加
    public function received(Request $request){

        $review = DB::table('reviews');

        //テスト mailと商品Idは固定
        $insert = $review
        ->insert(
            [
                'product_id'=>$request->product_id,
                'user_id'=>$request->user_id,
                'title'=>$request->title,
                'article'=>$request->article,
                'score'=>$request->rating,
                'created_at'=>now(),
            
            ]
        );

    }

    //レビュー表からデータ取得
    public function get_reviews(Request $request){

        $review = DB::table('reviews');
        $review_row = $review->where('product_id',$request->id)->get();
        return $review_row;
    }

    //レビューの平均を返す
    public function get_reviews_avg(Request $request){

        $review = DB::table('reviews');
        $review_avg = $review
                ->where('product_id',$request->id)
                ->avg('score');

        return (float)$review_avg;
    }
}
