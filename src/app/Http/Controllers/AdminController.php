<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;


class AdminController extends Controller
{
    public function index(){
        $contacts = Contact::paginate(7);  // 1ページに7件表示
        $categories = Category::all(); // 追加: カテゴリデータを取得
        return view('admin', compact('contacts', 'categories'));
    }



    public function search(Request $request){

        // Contactモデルとcategoryのリレーションを指定
        // withメソッドにより関連するcategoryデータを一緒に取得。
        $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->GenderSearch($request->gender)
        ->CategorySearch($request->category_id)
        ->DateSearch($request->date)
        ->paginate(10);  // 1ページに10件表示
        // ->get();

        // dd($contacts->toArray());  // クエリ結果を出力して確認

        // contactモデルのレコードとそれに紐づくcategoryテーブルのレコードを取得
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
