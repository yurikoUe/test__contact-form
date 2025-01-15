<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){

        // フォームデータを取得
        $user = $request->only(['name', 'email', 'password']);

        // パスワードを暗号化
        $user['password'] = bcrypt($user['password']);

        // dd($user);

        // データベースに保存する
        User::create($user);

        // ログイン画面にリダイレクト
        return redirect('/login');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){

        // フォームデータを取得
        $credentials = $request->only(['email', 'password']);

        // Userモデルを使ってemailでユーザーを検索し、Hash::check()を使ってパスワードを検証
        $user = User::where('email', $credentials['email'])->first();

        // パスワードの検証
        if ($user && Hash::check($credentials['password'], $user->password)) {
            //認証が成功したら、ユーザーをログイン状態にする
            Auth::login($user);

            // ログイン成功
            return redirect()->intended('/admin'); // 管理画面にリダイレクト
        }

        // ログイン失敗
        return back()->withErrors([
            'password' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    // public function admin()
    // {
    //     return view('admin');  
    // }

}
