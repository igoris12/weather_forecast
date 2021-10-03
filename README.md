1.
setup use xampp
download xampp from link: https://www.apachefriends.org/download.html
get 8.0.11 / PHP 8.0.11 version
install it and go to XAMPP control panel there start Apache and MySQL

2.
Download ZIP from git link: https://github.com/igoris12/weather_forecast
go to => LocalDisk (C) => xampp =>htdocs
and put folder from ZIP there.

XAMPP control panel click on MySQL Admin
then in phpmyadmin create new database with name (abeo_task).

open folder<h1>weather_forecast-master</h1> in code editor and in terminal use command
$ npm i
$ composer install
$ composer require vlucas/phpdotenv
$ php artisan key:generate
migration and seeder
$ php artisan migrate:fresh
$ php artisan migrate:fresh --seed

then you will get new file .env.example rename it to .env
next open file .env check that DB_DATABASE will be => abeo_task or if you used other name then use it.

next in browser go to link: http://localhost/weather_forecast-master/public/
click login
email: admin@gmail.com
pass: 123

registration is disabled
and that is all you need to do.

if you will use something else not xampp
database name (abeo_task).
you will be need use this command
$ npm i
$ composer install
$ composer require vlucas/phpdotenv
$ php artisan key:generate

and
migration and seeder
$ php artisan migrate:fresh
$ php artisan migrate:fresh --seed
