<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'],function()
{
    Route::get('news/create','Admin\NewsController@add')->middleware('auth');
});

//laravel09 課題１　routing

/*
laravel09 課題２　
group化のメリットは、一つのコントローラーに実装されているそれぞれの
Actionへのroutingをまとめて記述する事ができるので、エラーの修正や
新しい機能を追加するために、特定のコントローラーの設定を探そうと
考えた場合、すぐに見つけ出す事ができる事です。
*/

//laravel09 課題３　
Route::get('XXX','XXX\AAAController@BBB');

//laravel09 課題４
Route::group(['prefix' => 'admin'],function()
{
    Route::get('profile/create','Admin\ProfileController@add');
    Route::get('profile/edit','Admin\ProfileController@edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
