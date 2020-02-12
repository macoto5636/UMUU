<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    //注文を登録
    public function add(Request $request){
        $order = new \App\Order();
        $order -> user_id = request('user_id');
        $order -> state_id = request('state_id');
        $order -> payment_id = request('payment_id');
        $order -> shipping_id = request('shipping_id');
        $order -> created_at = now();

        $order -> save();

        $last_insert_id = $order -> id;

        return $last_insert_id;

    }

    //注文詳細を登録
    public function add_detail(Request $request){
        $order = new \App\Orderdetail();
        $order -> order_id = request('order_id');
        $order -> product_id = request('product_id');
        $order -> number = request('number');
        $order -> price = request('price');

        $order -> save();

        $product = \App\product::where('id',$request->product_id)->first();
        $product -> stock -= request('number');
        $product -> save();
    }

    //注文を取得
    public function index(Request $request){
        $item = \App\Order::orderBy('created_at','desc')->get();
        return $item;
    }

    //注文を取得
    public function index2(Request $request){
        $item = \App\Order::orderBy('created_at','desc')->first();
        return $item;
    }

    //注文を取得
    public function get(Request $request){
        $items = DB::table('orders')
                ->join('payments','orders.payment_id','=','payments.id')
                ->join('shippings','orders.shipping_id','=','shippings.id')
                ->join('orderstates','orders.state_id','=','orderstates.id')
                ->select('orders.*','orderstates.state_name','payments.payment_name','shippings.shipping_name','shippings.postage')
                ->get();
        
        return $items;
    }

    public function getDetail(Request $request){
        $item = DB::table('orders')
                ->join('users','orders.user_id','=','users.id')
                ->join('payments','orders.payment_id','=','payments.id')
                ->join('shippings','orders.shipping_id','=','shippings.id')
                ->join('orderstates','orders.state_id','=','orderstates.id')
                ->select('orders.*','users.*','orderstates.state_name','payments.payment_name','shippings.shipping_name','shippings.postage')
                ->where('orders.id',$request->id)
                ->first();
        
        return response()->json($item);
    }

    //注文状態の変更
    public function edit(Request $request){
        $order = \App\Order::where('id',$request->id)->first();
 
        $order -> state_id = request('state_id');

        $order -> save();
    }

    //ユーザ毎の注文を取得
    public function user(Request $request){
        $item = DB::table('orders')
                ->join('payments','orders.payment_id','=','payments.id')
                ->join('shippings','orders.shipping_id','=','shippings.id')
                ->join('orderstates','orders.state_id','=','orderstates.id')
                ->select('orders.*','orderstates.state_name','payments.payment_name','shippings.shipping_name','shippings.postage')
                ->where('orders.user_id',$request->id)
                ->orderBy('id','desc')
                ->get();
        return $item;
    }

    public function user_detail(Request $request){
        $item = \App\Orderdetail::where('order_id',$request->id)->get();
        $item = DB::table('orderdetails')
                ->join('products','orderdetails.product_id','=','products.id')
                ->join('categories','products.category_id1','=','categories.id')
                ->select('orderdetails.*','products.category_id1','products.product_name','products.price as product_price','categories.category_name')

                ->where('order_id',$request->id)->get();

        return $item;
    }

    //送料を取り出す
    public function user_shipping(Request $request){
        $item = \App\Shipping::where('id',$request->id)->get();
        return $item;
    }

    //注文状況
    public function user_state(Request $request){
        $item = \App\Orderstates::where('id',$request->id)->get();
        return $item;
    }

    //注文ごとの商品を取得
    public function order_product(Request $request){

        $product = \App\product::where('id',$request->id)->first();
        return $product;
    }

    //配送方法を取得
    public function shipping_get(Request $request){
        $shipping = \App\Shipping::find($request->id);
        return $shipping;
    }

    //日付で絞り込む
    public function nikkei(Request $request){
        $date = request('date');
       $sales = \App\Order::join('shippings','orders.shipping_id','=','shippings.id')
       ->select('orders.*','shippings.shipping_name','shippings.postage')
       ->whereDate('created_at',$request->date)->get();
        
       return $sales;
    }

}
