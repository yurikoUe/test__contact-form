<div class="contact-details">
    <button wire:click="openModal({{ $contact->id }})" class="btn btn-primary contact-details__button">詳細</button>

    @if($showModal)
        <!-- モーダルのコンテンツ -->
        <div class="modal modal--active">
            <div class="modal__content">
                <button wire:click="closeModal" class="modal__close-button">×</button>
                <table class="modal__table">
                    <tr class="modal__table-row">
                        <th class="modal__table-header">お名前</th>
                        <td class="modal__table-data">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">性別</th>
                        <td class="modal__table-data">{{ $contact->gender == 'male' ? '男性' : '女性' }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">メールアドレス</th>
                        <td class="modal__table-data">{{ $contact->email }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">電話番号</th>
                        <td class="modal__table-data">{{ $contact->tel }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">住所</th>
                        <td class="modal__table-data">{{ $contact->address }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">建物名</th>
                        <td class="modal__table-data">{{ $contact->building }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">お問い合わせの種類</th>
                        <td class="modal__table-data">{{ $contact->category->content ?? 'なし' }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-header">お問い合わせの内容</th>
                        <td class="modal__table-data">{{ $contact->detail }}</td>
                    </tr>
                </table>
                <!-- 削除ボタン -->
                <button wire:click="deleteContact" class="modal__delete-button">削除</button>
            </div>
        </div>
    @endif
</div>


<style>

/* ボタン */
.btn {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-primary {
    color: #d0c6b5;
    border:1px solid #d0c6b5;
    background-color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* モーダル */
.modal {
    display: none; /* 初期状態では非表示 */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* モーダルが他の要素の上に表示されるように */
    color: #8B7969;
}

.modal--active {
    display: flex; /* 表示時は flex に変更 */
}

.modal__content {
    background: white;
    padding: 30px;
    width: 500px;
    margin: 10%;
    border: solid 1px #8B7969;
    position: relative;
    border-radius: 8px; /* 角を丸くする */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 少し影をつける */
    font-size: 14px;
    height: 85%;
    display: flex;
    flex-direction: column; /* 縦並びに */
    justify-content: center; /* コンテンツを縦方向に中央配置 */
    align-items: center; /* 横方向に中央配置 */
}

.modal__close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    color: #888;
    border-radius: 50%; /* 丸にする */
    border: 1px;
    border: 1px solid #888; /* #888色の枠線を設定 */
}

.modal__close-button:hover {
    color: #333;
}

/* テーブル */
.modal__table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}


.modal__table-header {
    text-align: left;
    padding: 5px;
    width: 40%;
    vertical-align: top; /* 上揃えに設定 */
}

.modal__table-data {
    padding: 5px;
    width: 60%;
    vertical-align: top; /* 上揃えに設定 */
}

/* 削除ボタンのスタイル */
.modal__delete-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 15px;
    font-size: 14px;
    cursor: pointer;
    margin-top: 20px;
    width: auto; /* 自動幅に設定 */
    align-self: center; /* 親要素の中央に配置 */
}

.modal__delete-button:hover {
    background-color: #c82333;
}

</style>