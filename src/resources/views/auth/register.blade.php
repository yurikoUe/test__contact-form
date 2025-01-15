@extends('layouts.app') <!-- 親レイアウトを指定 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('nav')
    <!-- ナビゲーション -->
            <nav class="header__nav">
                <ul>
                    <li><a href="/login">login</a></li>
                </ul>
            </nav>
@endsection

@section('content') <!-- 親レイアウトのcontent部分に挿入 -->
    <h1 class="register__title">Register</h1>
    <div class="register__container">
        <form action="/register" method="post" class="register__form">
            @csrf
            <div class="register__form-group">
                <label for="name" class="register__label">お名前</label>
                <input type="text" id="name" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" class="register__input"/>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="register__form-group">
                <label for="email" class="register__label">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="例：test@example.com"  value="{{ old('email') }}" class="register__input"/>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="register__form-group">
                <label for="password" class="register__label">パスワード</label>
                <input type="password" id="password" name="password" placeholder="例：coachtech1106" class="register__input">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="register__form-group">
                <button type="submit" class="register__button">登録</button>
            </div>
        </form>
    </div>
@endsection