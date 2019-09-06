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

Route::group(['middleware'=>'admin'],function(){
    Route::resource('admin/users', 'AdminUsersController');
});

Route::get('/admin', 'AdminUsersController@index')->name('admin-users');
Route::post('/admin/users/store', 'AdminUsersController@store')->name('store');
Route::get('/admin/users/edit/{id}', 'AdminUsersController@edit')->name('edit');
Route::put('/admin/users/update/{id}', 'AdminUsersController@update')->name('update');
Route::get('/admin/users/destroy/{id}', 'AdminUsersController@destroy')->name('destroy');
Route::resource('admin/users', 'AdminUsersController');


