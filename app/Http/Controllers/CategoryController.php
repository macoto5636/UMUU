<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//カテゴリーモデル使用
use App\category;


class CategoryController extends Controller
{
    //カテゴリ表のレコードを表示
    public  function index(Request $request)
    {
        $items = \App\category::get();
        return $items;
    }
    //追加画面
    public function add(Request $request)
    {
        return view('category.add');
    }
    //レコードをカテゴリーテーブルに追加
    public function insert(Request $request)
    {
      //$this->validate($request, category::$rules);
        $category = new category;
        $category->category_name = $request->category_name;
        $category->save();
        return redirect('category');
    }
    //カテゴリー編集
    public function edit(Request $request)
    {
        $category = category::find($request->id);
        return view('category.edit',['items' => $category]);

    }

    //カテゴリーテーブル更新
    public function update(Request $request)
    {
        $category = category::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $category->fill($form)->save();

        return redirect('category');
    }

    //カテゴリ削除確認画面
    public function delete(Request $request)
    {
        //選択したカテゴリを削除確認画面に送信
        for($i = 0; $i < count($request->id); $i++){
            $items[$i] = category::where('id', $request->id[$i])->get();
        }
        return view('category.delete',['items' => $items]);
    
    }
    
    //カテゴリ削除処理
    public function deleted(Request $request)
    {
        for($i = 0; $i < count($request->id); $i++){
            category::find($request->id[$i])->delete();
        }
        return redirect('category');
    }


}
