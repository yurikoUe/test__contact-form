@extends('layouts.app') <!-- 親レイアウトを指定 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection



@section('content') <!-- 親レイアウトのcontent部分に挿入 -->

    @php
        $sessionData = session('form_data');
    @endphp

    <!-- @if($sessionData)
        <p>セッションデータがあります:</p>
        <ul>
            <li>名前: {{ $sessionData['first_name'] }} {{ $sessionData['last_name'] }}</li>
            <li>性別: {{ $sessionData['gender'] }}</li>
            <li>メール: {{ $sessionData['email'] }}</li>
            
        </ul>
    @else
        <p>セッションデータがありません。</p>
    @endif -->

    <h1 class="index__title">Contact</h1>
    <div class="contact__container">
        <form action="/confirm" method="POST" class="contact__form">
            @csrf
            <!-- フォームの内容 -->
            <table class="contact-table">

                <tr>
                    <th>
                        <label for="name" class="form-label">お名前<span class="required">※</span></label>
                    </th>
                    <td>
                        <div class="contact-table__name">
                            <input class="contact__input contact__input-name" type="text" id="name" name="first_name" placeholder="例：山田" value="{{ old('first_name', session('form_data.first_name')) }}" /><input class="contact__input contact__input-name" type="text" id="name" name="last_name" placeholder="例：太郎" value="{{ old('last_name', session('form_data.last_name')) }}" />
                        </div>
                        <div>
                            @error('first_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            @error('last_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                   
                </tr>

                <tr>
                    <th><label for="gender" class="form-label">性別<span class="required">※</span></label></th>
                    <td>
                        <div class="contact-table__gender">
                            <div class="contact-table__gender-0">
                                <label for="male">男性</label>
                                <input class="contact__input" type="radio" id="male" name="gender" value="1" {{ old('gender', session('form_data.gender')) == 1 ? 'checked' : '' }} checked>
                            </div>
                            <div class="contact-table__gender-1">
                                <label for="female">女性</label>
                                <input class="contact__input" type="radio" id="female" name="gender" value="2" {{ old('gender', session('form_data.gender')) == 2 ? 'checked' : '' }}>
                            </div>
                            <div class="contact-table__gender-2">
                                <label for="other">その他</label>
                                <input class="contact__input" type="radio" id="other" name="gender" value="3" {{ old('gender', session('form_data.gender')) == 3 ? 'checked' : '' }}>
                            </div>
                            <div>
                                @error('gender')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="email" class="form-label">メールアドレス<span class="required">※</span></label>
                    </th>
                    <td>
                        <input class="contact__input" type="email" id="email" name="email" placeholder="例：test@example.com" value="{{ old('email', session('form_data.email')) }}" />
                        <div>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="tel" class="form-label">電話番号<span class="required">※</span></label>
                    </th>
                    <td>
                        <div class="contact-table__tel">
                            <input class="contact__input" type="text" name="tel_part1" placeholder="080" value="{{ old('tel_part1', session('form_data.tel_part1')) }}" id="tel"> -
                            <input class="contact__input" type="text" name="tel_part2" placeholder="1234" value="{{ old('tel_part2', session('form_data.tel_part2')) }}" /> -
                            <input class="contact__input" type="text" name="tel_part3" placeholder="5678" value="{{ old('tel_part3', session('form_data.tel_part3')) }}" />
                            <div>
                                @error('tel_part1')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @error('tel_part2')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @error('tel_part3')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="address" class="form-label">住所<span class="required">※</span></label>
                    </th>
                    <td>
                        <input class="contact__input" type="text" id="address" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', session('form_data.address')) }}" />
                        <div>
                            @error('address')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="building" class="form-label">建物名</label>
                    </th>
                    <td>
                        <input class="contact__input" type="text" id="building" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building', session('form_data.building')) }}" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="category" class="form-label">お問い合わせの種類<span class="required">※</span></label>
                    </th>
                    <td>
                        <select name="category_id" id="category" class="contact__input">
                            <option value="" {{ old('category_id', session('form_data.category_id')) == '' ? 'selected' : '' }}>選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', session('form_data.category_id')) == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                        <div>
                            @error('category_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="detail" class="form-label">お問い合わせ内容<span class="required">※</span></label>
                    </th>
                    <td>
                        <textarea class="contact__input" id="detail" name="detail" cols="30" placeholder="例：お問い合わせ内容をご記載ください">{{ old('detail', session('form_data.detail')) }}</textarea>
                        <div>
                            @error('detail')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
            </table>
            <div class="contact-btn">
                <button type="submit" class="contact-btn__submit">確認画面</button>
            </div>
        </form>
    </div>
    
@endsection

