<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // フォームの表示
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }
    
    public function confirm(ContactRequest $request)
    {
        // フォームデータを全て取得
        $form = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel_part1', 'tel_part2', 'tel_part3', 'address', 'building', 'category_id', 'detail']);

        // デバッグ用: 受け取ったデータを確認
        // dd($form);
        
        // カテゴリー名を取得
        $category = Category::find($form['category_id']);
        $form['category_name'] = $category->content;

        // // セッションにフォームデータを保存
        $request->session()->put('form_data', $form);

        // \Log::info(session('form_data'));

        return view('confirm', compact('form'));
    }

    public function store(Request $request)
    {

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);

        // dd($contact);

        // genderを文字列から数値に変換
        $gender = (int) $request->input('gender');

        // 数値に変換したgenderを追加
        $contact['gender'] = $gender;

        // デバッグ用: 受け取ったデータを確認
        // dd($contact);

        // 電話番号を結合してハイフンを取り除く
        $tel_part1 = $request->input('tel_part1');
        $tel_part2 = $request->input('tel_part2');
        $tel_part3 = $request->input('tel_part3');
        $contact['tel'] = $tel_part1 . $tel_part2 . $tel_part3;

        // dd($contact);

        // データベースに保存する
        Contact::create($contact);

        // セッションをクリア
        $request->session()->forget('form_data');

        return view('thanks');
    }

}
