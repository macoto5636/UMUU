<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class WantsController extends Controller
{
    public function index(){
        return view('wants.index');
    }


    //wants表取得
    public function user_get(Request $request){
        //ログインしているユーザのほしい物リストを取得

        $item = DB::table('wants')
                   ->join('products','products.id','=','wants.product_id')
                   ->select('wants.id','wants.product_id','products.product_name','products.price','products.image')
                 ->where('user_id', $request->id)->get();

	    return $item;
    }

    //wants表ユーザが存在しているかチェック
    public function check(Request $request){
        $items = \App\Want::where('user_id',$request->user_id)->where('product_id',$request->product_id)->get();

        return $items;
    }

    //wants表追加
    public function add(Request $request){
        $want = new \App\Want();
        $want -> user_id = request('user_id');
        $want -> product_id = request('product_id');

        $want -> save();
    }

    //wants表削除
    public function delete(Request $request){
        $item = \App\Want::find($request->id);
        $item->delete();

        return response()->json([
            'success' => 'item deleted successfully!'
        ]);
    }
}
