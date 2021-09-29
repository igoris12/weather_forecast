<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'recommendations'], function(){
   Route::get('', [RecommendationController::class, 'index'])->name('recommendation.index');
//    Route::get('create', [RecommendationController::class, 'create'])->name('recommendation.create');
  
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
