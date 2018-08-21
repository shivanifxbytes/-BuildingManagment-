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

Route::get('/admins', '\App\Modules\Admin\Controllers\AdminController@index')->name('admins')->middleware('auth');
Route::get('/admins.create', '\App\Modules\Admin\Controllers\AdminController@create')->name('admins.create')->middleware('auth');
Route::post('/admins.store', '\App\Modules\Admin\Controllers\AdminController@store')->name('admins.store')->middleware('auth','admin');
Route::get('/users', '\App\Modules\Users\Controllers\UserController@index')->name('user')->middleware('auth');
Route::get('/maintenances', '\App\Modules\Maintenance\Controllers\MaintenanceController@index')->name('maintenances')->middleware('auth');
Route::get('/maintenances.create', '\App\Modules\Maintenance\Controllers\MaintenanceController@create')->name('maintenances.create')->middleware('auth');
Route::post('/maintenances.store', '\App\Modules\Maintenance\Controllers\MaintenanceController@store')->name('maintenances.store')->middleware('auth','admin');
