@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('nav')
    <!-- ナビゲーション -->
    <nav class="header__nav">
        <ul>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <h1 class="admin-title">Admin</h1>

    <!-- 検索フォーム -->
        <form action="/admin/search" method="GET" class="search-form">

            <div class="search-form__container">

                <!-- キーワード検索 -->
                <div class="search-form__input-group">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスで検索" class="search-form__input">
                </div>

                <!-- 性別で絞り込み検索 -->
                <div class="search-form__input-group">
                    <select name="gender" class="search-form__select">
                        <!-- genderの値は整数（0, 1, 2）として保存 -->
                        <!-- フォームがリセットされずに入力された値を保持 -->
                        <option value="">性別</option>
                        <option value="null" {{ request('gender') === 'null' ? 'selected' : '' }}>全て</option>
                        <option value="0" {{ request('gender') === '0' ? 'selected' : '' }}>男性</option>
                        <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>女性</option>
                        <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>その他</option>
                        </select>
                </div>

                <!-- お問い合わせの種類で絞り込み検索 -->
                <div class="search-form__input-group">
                    <select name="category_id" class="search-form__select">
                        <option value="">お問い合わせの種類</option>
                        <!-- ここにカテゴリーをループで追加 -->
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 登録年月日で絞り込み検索 -->
                <div class="search-form__input-group">
                    <input type="date" name="date" value="{{ request('date') }}" class="search-form__input">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="form-buttons__submit">検索</button>
                    <button type="reset" onclick="window.location.href='/admin';" class="form-buttons__reset">リセット</button>

                </div>
            </div>
        </form>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $contacts->links() }}
        </div>

        <!-- 登録者の情報一覧 -->
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>登録年月日</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }}{{ $contact->last_name }}</td>
                        <td>{{ $contact->gender == 'male' ? '男性' : '女性' }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content ?? 'なし' }}</td>
                        <!-- <td>{{ $contact->created_at->format('Y-m-d') }}</td> -->
                        <td>
                            <!-- モーダルの読み込み -->
                            @livewire('contact-modal', ['contact' => $contact])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        
    </div>
@endsection
