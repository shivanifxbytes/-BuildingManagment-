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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admins', '\App\Modules\Admin\Controllers\AdminController@index')->name('admin')->middleware('auth');
Route::get('/users', '\App\Modules\Admin\Controllers\UserController@index')->name('user')->middleware('auth');
