1.
setup use xampp
download xampp from link: https://www.apachefriends.org/download.html
get 8.0.11 / PHP 8.0.11 version
install it and go to XAMPP control panel there start Apache and MySQL

2.
Download ZIP from git link: https://github.com/igoris12/weather_forecast <br>
go to => LocalDisk (C) => xampp =>htdocs<br>
and put folder from ZIP there.<br>

XAMPP control panel click on MySQL Admin<br>
then in phpmyadmin create new database with name (abeo_task).<br>

open folder weather_forecast-master in code editor and in terminal use command <br>
$ npm i <br>
$ composer install <br>
$ composer require vlucas/phpdotenv <br>
$ php artisan key:generate <br>
migration and seeder <br>
$ php artisan migrate:fresh <br>
$ php artisan migrate:fresh --seed <br>

then you will get new file .env.example rename it to .env<br>
next open file .env check that DB_DATABASE will be => abeo_task or if you used other name then use it.<br>

next in browser go to link: http://localhost/weather_forecast-master/public/<br>
click login<br>
email: admin@gmail.com<br>
pass: 123<br>

registration is disabled<br>
and that is all you need to do.<br>

if you will use something else not xampp<br>
database name (abeo_task).<br>
you will be need use this command<br>
$ npm i<br>
$ composer install<br>
$ composer require vlucas/phpdotenv<br>
$ php artisan key:generate<br>

and
migration and seeder<br>
$ php artisan migrate:fresh<br>
$ php artisan migrate:fresh --seed<br>

link to project in web for now is not working and it is in progress.
