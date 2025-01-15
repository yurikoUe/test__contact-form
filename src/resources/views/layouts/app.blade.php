<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}"/>
    @yield('css')
    @livewireStyles <!-- ここでLivewireのスタイルを読み込む -->
</head>
<body class="body">
    <header class="header">

            <!-- ログイン・登録ページのナビゲーション -->
            <div div class="header__inner">
                <div class="header__reft"></div>
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>
                @yield('nav')
            </div>

    </header>

    @yield('content')
    
    @livewireScripts <!-- Livewireのスクリプトを読み込むため、body終了前に追加 -->
</body>
</html>