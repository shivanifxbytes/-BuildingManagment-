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

Route::get('/welcome', 'UserController@index');
Route::group(['middleware' => ['web']], function () {
Route::get('/userrMaintenance/{id?}/{user_id?}', ['as'=>'userrMaintenance','uses'=>'UserController@userrMaintenance']);
 });
Route::get('/register', 'UserController@register');

// Admin Login routes
Route::get('/', 'AdminController@getLogin');
Route::post('/', 'AdminController@postLogin');

// Admin Dashboard 
Route::group(['middleware' => ['web']], function () {
        Route::get('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index']);
 });
// Admin users route
Route::group(['middleware' => ['web']], function () {
        Route::get('/users', ['as'=>'users','uses'=>'DashboardController@users']);
 });
Route::group(['middleware' => ['web']], function () {
        Route::get('/adminUser', ['as'=>'adminUser','uses'=>'DashboardController@users']);
 });
Route::get('dashboard/queryData', 'DashboardController@users');
Route::get('dashboard/show', 'DashboardController@showmaintenance');
// Admin Add edit route
Route::group(['middleware' => ['web']], function () {
        Route::get('/addUser/{user_id?}', ['as'=>'adduser','uses'=>'DashboardController@getUser']);
        Route::post('/addUser/{user_id?}', ['as'=>'edituser','uses'=>'DashboardController@postuser']);
 });
// Admin Dashboard show maintenance list Add edit route for maintenance
Route::group(['middleware' => ['web']], function () {
        Route::get('/showMaintenance/{id?}', ['as'=>'showmaintenance','uses'=>'DashboardController@showmaintenance']);
        // Admin Dashboard Add user
        Route::get('/addMaintenance/{id?}/{user_id?}', ['as'=>'addmaintenance','uses'=>'DashboardController@addMaintenance']);
        // Admin Dashboard Edit user
        Route::get('/editmaintenance/{id?}/{user_id?}', ['as'=>'editmaintenance','uses'=>'DashboardController@editMaintenance']);
        // Admin Dashboard Post user
		Route::post('/addMaintenance/{id?}/{user_id?}', ['as'=>'editmaintenance','uses'=>'DashboardController@postMaintenence']);
		 });
// Admin Dashboard delete user
Route::post('/deleteUser','DashboardController@deleteUser');

 

Route::get('/logout','DashboardController@getLogout');
