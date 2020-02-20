<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//モデル
use App\product;
use App\category;
//use App\cart;
use App\shopping;

class ProductSearchController extends Controller
{
    public function index(Request $request)
    {
        return view('customer.product.search');
    }

    //商品詳細画面
    public function details(Request $request)
    {

        //カテゴリ名出せないごめん
        //$items = \App\product::where('id',$request->id)->first();

        
        $items = DB::table('products')
        ->join('categories','products.category_id1','=','categories.id')
        ->select('products.*','categories.category_name')
        ->where('products.id', $request->id)->first();

        //$category = \App\product::where('category_id1',$items->category_id1)->get();
        return  response()->json($items);
    }
    //買い物カートに保存
    public function cart_push(Request $request)
    {
        //$user = Auth\user();
        //後々test@をuser->emailにします
        $shopping = shopping::where('email','test@gmail.com')->where('product_id', $request->pro_id)->first();
        if(isset($shopping)){
            //同じ商品がカートに入ってない確認する。あれば更新
            $shopping = shopping::where('email','test@gmail.com')->where('product_id', $request->pro_id)->first();
            $shopping->email = 'test@gmail.com';
            $shopping->product_id = $request->pro_id;
            $shopping->number = strval((intval($shopping->number) + intval($request->number)));
            $shopping->save();
            
            //見つからなかった場合あたらしく追加
        }else{
            $shopping = new shopping;
            $shopping->email = 'test@gmail.com';
            $shopping->product_id = $request->pro_id;
            $shopping->number = $request->number;
            $shopping->save();
        }
        //cart_puah画面で追加された商品の画像・現在のカートの商品数を表示すために使用
        $items = product::find($request->pro_id);
        $shopping_num = shopping::find('test@gmail.com')->count();
        if(!isset($shopping_num)){
            $shopping_num = 0;
        }

        return view('customer.product.cart_push',['items' => $items, 'shopping_num' => $shopping_num]);
    }

    //商品データを渡す
    public function get(Request $request){  //←追記
        //$items = \DB::table('products')->join('categories','products.category_id1','=','categories.id')->get();
        $items = \App\product::get();
        return $items;
    }

    //商品データを渡す
    public function getDisplay(Request $request){  //←追記
        //$items = \DB::table('products')->join('categories','products.category_id1','=','categories.id')->get();
        $items = \App\product::where('display','1')->get();
        return $items;
    }

    //検索結果を受け取る現在商品名で検索している。
    //後々カテゴリでも検索できるようにしたいやる気が出ない
    public function search(Request $request){  //←追記
        //$result = \App\product::where('product_name', 'Like', '%' .  $request->keyword . '%')->where('display','1')->get();
        //return $result;

        if($request->category_id == 0){
            $result = \App\product::where('product_name', 'Like', '%' .  $request->keyword . '%')->where('display','1')->get();
        }else{
            $result = \App\product::where('product_name', 'Like', '%' .  $request->keyword . '%')->where('category_id1','=',$request->category_id)->where('display','1')->get();
        }

        return $result;
    }

    public function category(Request $request){
        $result = \App\product::where('category_id1','=',$request->category_id)->where('display','1')->get();
        return $result;
    }

     //関連商品現在は商品表から６件データを取得そのうち改良します。
     //もし作っているならこれ削除してください
     public function relation(Request $request){  //←追記
        $result = \App\product::limit(6)->where('display','1')->orderBy('created_at','desc')->get();
        return $result;
     }


}
