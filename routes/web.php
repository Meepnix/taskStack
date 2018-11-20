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


/* Admin */

Route::get('/admin/groups', 'AdminGroupController@show')->name('admin.group.show')->middleware('auth');


Route::get('/admin/tasks', 'AdminTaskController@show')->name('admin.task.show');
Route::get('/admin/tasks/create', 'AdminTaskController@create')->name('admin.task.create');
Route::post('/admin/tasks/store', 'AdminTaskController@store')->name('admin.task.store');



Route::get('/meep', function () {
    return view('welcome');
});

Route::get('/task', function () {
    return view('Tasks.index');

});

Route::get('/task/index', 'TaskController@index')->name('task.index');


Route::get('/logtest', '\App\Http\Controllers\Auth\LoginController@login');


//http://localhost:8001/logtest?name=batman&password=batman

Route::get('/home', 'HomeController@index')->name('home');
