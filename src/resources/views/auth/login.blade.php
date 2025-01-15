@extends('layouts.app') <!-- 親レイアウトを指定 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('nav')
    <!-- ナビゲーション -->
            <nav class="header__nav">
                <ul>
                    <li><a href="/register">register</a></li>
                </ul>
            </nav>
@endsection

@section('content') <!-- 親レイアウトのcontent部分に挿入 -->
    <h1 class="login__title">Login</h1>
    <div  class="login__container">
        <form action="/login" method="post" class="login__form">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }} " class="form-input"/>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" id="password" name="password" placeholder="例：coachtech1106" class="form-input">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-action">
                <button type="submit" class="submit-button">ログイン</button>
            </div>
        </form>
    </div>
@endsection