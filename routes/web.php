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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/groups', 'AdminGroupController@show')->name('group.show')->middleware('auth');

Route::get('/meep', function () {
    return view('welcome');
});

Route::get('/logtest', '\App\Http\Controllers\Auth\LoginController@login');


//http://localhost:8001/logtest?name=batman&password=batman

Route::get('/home', 'HomeController@index')->name('home');
