# test__contact-form

## 環境構築
### Dockerビルド
1. git clone <https://github.com/yurikoUe/test__contact-form.git>
2. docker-compose up -d --build
MySQLがOSによって起動しない場合があるため、必要に応じてdocker-compose.ymlファイルを編集してください。特に、Windowsユーザーはファイル共有設定に注意してください。

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. cp .env.example .env
env.exampleからenv.を作成し環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術
PHP 7.4.9
Laravel 8.83.29
MySQL 8.0.26
Nginx 1.21.1
phpMyAdmin

##ER図
<!-- ER図の画像パスに変更してください -->

## URL
開発環境: http://localhost
phpMyAdmin: http://localhost:8080