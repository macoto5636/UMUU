<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//モデル
use App\product;
use App\category;
//フォームリクエスト
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //public function select_stock(){
    //    $puroducts = \DB::table('products')
    //    ->join('categories','products.category_id','=','categories.id')
    //    ->get();

    //    return $products;
    //}

     //商品表のレコードを表示
     public function index(Request $request)
     {
        $itams;
        //sortをするかしないか
        if(isset($request->sort)){
            $items = DB::table('products')
                    ->join('categories','products.category_id1','=','categories.id')
                    ->select('products.*','categories.category_name')
                    ->get();
        }else if($request->search){
            //商品名検索時
            $items = DB::table('products')
                    ->join('categories','products.category_id1','=','categories.id')
                    ->select('products.*','categories.category_name')
                    ->where('name', 'LIKE', '%' . $request->search . '%')
                    ->get();
        }else{
            $items = DB::table('products')
                    ->join('categories','products.category_id1','=','categories.id')
                    ->select('products.*','categories.category_name')
                    ->get();
        }
             
        return $items;
 
     }
     //追加フォーム
     public function add(Request $request)
     {
         return view('product.add');
     }
     //商品表にレコードを追加
     public function insert(Request $request)
     {
         //画像処理
         $image_file = $request->image;

         //ファイル名取得
         $file_name = $image_file->getClientOriginalName();
         //pulic/storageに保存    
         $image_file->storeAs('product_image/',$file_name,'public_uploads');
 
         $product = new \App\product;
         $product->product_name = $request->product_name;
         $product->price = $request->price;
         $product->stock = $request->stock;
         $product->product_details = $request->product_details;
         $product->component_details = $request->component_details;
         $product->created_at = now();
         //$product->image = str_replace('public/product_image', '', $file_path);
         $product->image = $file_name;
         //カテゴリ名からidを検索
         //$get_calum =  DB::table('categoryies')->where('category_name', $request->category_name)->first();
         //$product-> category_id1 = $get_calum->id;
         $product->category_id1 = $request->category_name;
         $product->display =  $request->display;
         $product->save();
 
     }
 
     //商品レコード編集
     public function edit(Request $request)
     {
         $product = \App\product::where('id',$request->id)->first();
         $product -> stock += request('stock');

         $product -> save();
     }
 
     //商品更新
     public function update(Request $request)
     {
         //画像処理
         //$image_file = $request->image;
         //pulic/storageに保存
         //$file_path = $image_file->store('public');
        
         $product = \App\product::find($request->id);
         $product-> product_name = request('product_name');
         $product-> price = request('price');
         $product-> product_details = request('product_details');
         $product-> component_details = request('component_details');
         //$product->image = str_replace('public/', '', $file_path);
         $get_calum =  \App\category::where('category_name', $request->category_name)->first();
         $product-> category_id1 = $get_calum->id;
         $product->display = $request->display;
         $product->save();
 
     }
 
     //商品削除確認画面
     public function delete(Request $request)
     {
         //選択した商品を削除確認画面に送信
         for($i = 0; $i < count($request->id); $i++){
             $items[$i] = product::where('id', $request->id[$i])->get();
         }
         return view('product.delete',['items' => $items]);
 
     }
 
     //商品削除処理
     public function deleted(Request $request)
     {
         for($i = 0; $i < count($request->id); $i++){
 
             //画像の削除なぜかできないパスはあってるはずなんだが…
             //現状storageの画像が削除できないので、storageにゴミファイルがどんどん溜まっていきます
             //unlink(storage_path($request->image[$i]));
             product::find($request->id[$i])->delete();
   
         }
         return redirect('product');
     }

    //商品管理で全商品をexcelに出力するためのデータを取得
    public function getExcelDate(Request $request){

        $items = DB::table('products')
            ->join('categories','products.category_id1','=','categories.id')
            ->select('products.id as 商品ID', 'products.product_name as 商品名', 'product_details as 商品詳細','products.price as 価格',
            'products.stock as 在庫','categories.category_name as カテゴリ')
            ->get();
    
        return $items;
    }
}
