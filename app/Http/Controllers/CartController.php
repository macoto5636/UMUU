<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//モデル
use App\product;
use App\cart;

class CartController extends Controller
{
    public function index(Request $request){

        return view('cart.index');
    } 
    
    public function user_get(Request $request){
        $item = DB::table('shoppings')
                   ->join('products','products.id','=','shoppings.product_id')
                   ->select('shoppings.id','shoppings.number','shoppings.product_id','products.product_name','products.stock','products.price','products.image')
                   ->where('shoppings.user_id', $request->id)->get();
        return $item;
    }

    public function product_get(Request $request){
        $item = \App\cart::where('user_id', $request->id)
                ->where('product_id',$request->pro_id)->first();
        return $item;
    }

    public function count(Request $request){
        $count = \App\cart::where('user_id', $request->id)->count();

        return $count;
    }

    public function delete(Request $request){
        $shopping = \App\cart::find($request->id);
        $shopping->delete();

        return response()->json([
            'success' => 'item deleted successfully!'
        ]);
    }

    public function add(Request $request){
        //カートに既にデータが入っているかチェック
        $data = \App\cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();
        if(isset($data)){
            $data -> number += request('number');
            $data->save();
        }else{
            $shopping = new \App\cart();
            $shopping -> user_id = request('user_id');
            $shopping -> product_id = request('product_id');
            $shopping -> number = request('number');

            $shopping -> save();
        }
    }

    public function edit(Request $request){
        $data = \App\cart::where('user_id',$request->user_id)->where('product_id',$request->product_id)->first();

        $data -> number = request('number');
        $data->save();
    }

}
