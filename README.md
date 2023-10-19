# Pheonix.tech

* npm 8.19.2
* node v18.12.1
* php 8.1.6
* composer 2.3.8 (не только глобально, но и в проект)
* xampp (для виртуального сервера)
* 7z (для распаковки зависимостей)

## Installation

1. PHP 8 or later (if you're on windows then xampp is recommended)
2. Download and install composer
3. Go to the project folder
4. composer install
5. npm install
6. Copy .env.example to the project folder and set all the necessary environment variables such as database credentials.
7. Run `php artisan migrate` to create tables in your database
8. Run `php artisan db:seed` to populate the database with data

## Installation (kdubasov)
1. установить глобально composer, nodejs, npm и php версии выше 8.0.0
2. запустить локальный сервер (xampp, openserver)
3. перейти в папку проекта
4. в терминале прописать `composer install` и после этого `npm install`
5. вместо файла .env.example поставить файл который я прикреплю и назвать его .env
6. в терминале прописать `php artisan migrate` и после этого `php artisan db:seed`
7. после этого в терминале прописать `php artisan serve` это запуск сервака 
8. после этого прописать `npm run dev` это запуск фронта
9. перейти на адрес `http://localhost:8000/` или тот который будет в терминале в котором вы запускали фронт

## Building and running

To start the server in development mode, run the following commands:

`php artisan serve`
and
`npm run dev`

These should be executed in two separate terminals.

If you want to build assets for production, then run:

`npm run build`

## Как выложить на сервак

Build: cd /var/www/pheonix

Ctrl+V: Shift + Insert

Герерирование токена на github:
https://docs.github.com/ru/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token#creating-a-fine-grained-personal-access-token
Используется для авторизации git вместо пароля.

Short Front build

1. cd ~/pheonix
2. git pull
3. npm run build
4. cd ~
5. sudo cp -r pheonix /var/www/

Full PHP build

1. cd ~/pheonix
2. git pull
3. composer install
4. [composer update]
5. npm install
6. [php artisan migrate]
7. php artisan migrate:fresh
8. php artisan db:seed
9. [php artisan serv] - локально
10. [npm run dev] - локально
11. npm run build
12. cd ~
13. sudo cp -r pheonix /var/www/
14. Выполнить `sudo chown -R www-data.www-data /var/www/pheonix/storage`
15. Выполнить `sudo chown -R www-data.www-data /var/www/pheonix/bootstrap/cache`

