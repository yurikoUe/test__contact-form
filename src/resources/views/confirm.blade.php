@extends('layouts.app') <!-- 親レイアウトを指定 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content') <!-- 親レイアウトのcontent部分に挿入 -->
    
    <!-- @php
        $sessionData = session('form_data');
    @endphp

    @if($sessionData)
        <p>セッションデータがあります:</p>
        <ul>
            <li>名前: {{ $sessionData['first_name'] }} {{ $sessionData['last_name'] }}</li>
            <li>性別: {{ $sessionData['gender'] }}</li>
            <li>メール: {{ $sessionData['email'] }}</li>
        </ul>
    @else
        <p>セッションデータがありません。</p>
    @endif -->



    <h1 class="confirm__title">Confirm</h1>
    <div class="confirm__container">
        <form action="/thanks" method="POST">
            @csrf
            <table border=1 class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>
                        <input type="text" name="first_name" value="{{ $form['first_name'] }}" readonly class="confirm__form"/>
                        <input type="text" name="last_name" value="{{ $form['last_name'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <!-- 変換マップを使って gender の値を日本語のラベルに変換 -->
                <?php
                    $genderLabels = [
                        '1' => '男性',
                        '2' => '女性',
                        '3' => 'その他',
                    ];
                ?>
                <tr>
                    <th>性別</th>
                    <td>
                        <input type="hidden" name="gender" value="{{ $form['gender'] }}" class="confirm__form"/>
                        <input type="text" name="gender" value="{{ $genderLabels[$form['gender']] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        <input type="email" name="email" value="{{ $form['email'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <div class="confirm-table__tel">
                            <input type="tel" name="tel_part1" value="{{ $form['tel_part1'] }}" readonly class="confirm__form"/>
                            <span>-</span>
                            <input type="tel" name="tel_part2" value="{{ $form['tel_part2'] }}" readonly class="confirm__form"/>
                            <span>-</span>
                            <input type="tel" name="tel_part3" value="{{ $form['tel_part3'] }}" readonly class="confirm__form"/>
                        </div>
                    </td>
                                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <input type="text" name="address" value="{{ $form['address'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        <input type="text" name="building" value="{{ $form['building'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        <input type="text" name="category_name" value="{{ $form['category_name'] }}" readonly class="confirm__form"/>
                        <input type="hidden" name="category_id" value="{{ $form['category_id'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        <input type="text" name="detail" value="{{ $form['detail'] }}" readonly class="confirm__form"/>
                    </td>
                </tr>
            </table>
            <div class="confirm__actions">
                <button type="submit">送信</button>
                <a href="{{ url('/') }}">修正</a>
            </div>
        </form>
    </div>
@endsection