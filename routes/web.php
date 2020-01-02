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

Route::group(['prefix' => 'admin'],function() {
    Route::get('news/create','Admin\NewsController@add')->middleware('auth');
    Route::post('news/create','Admin\NewsController@create')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth');
    Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth');
    Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth');
    Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
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
//Route::get('XXX','XXX\AAAController@BBB');

//laravel09 課題４
Route::group(['prefix' => 'admin'],function()
{
    Route::get('profile/create','Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit','Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/create','Admin\ProfileController@create');
    Route::post('profile/edit','Admin\ProfileController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});

//18章　フロントへのルーティングの設定
Route::get('/','NewsController@index');
