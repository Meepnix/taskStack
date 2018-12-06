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

//Groups

Route::get('/admin/groups', 'AdminGroupController@show')->name('admin.group.show');
Route::get('/admin/groups/create', 'AdminGroupController@create')->name('admin.group.create');
Route::post('/admin/groups/store', 'AdminGroupController@store')->name('admin.group.store');
Route::delete('/admin/groups/{group}', 'AdminGroupController@destroy')->name('admin.group.delete');

//Users
Route::delete('/admin/users/{user}', 'AdminUserController@destroy')->name('admin.user.delete');

//Tasks

Route::get('/admin/tasks', 'AdminTaskController@show')->name('admin.task.show');
Route::get('/admin/tasks/create', 'AdminTaskController@create')->name('admin.task.create');
Route::post('/admin/tasks/store', 'AdminTaskController@store')->name('admin.task.store');



Route::get('/meep', function () {
    return view('welcome');
});

Route::get('/task', function () {
    return view('Tasks.index');

});



//json
Route::get('/task/index', 'TaskController@index')->name('task.index');


Route::get('/logtest', '\App\Http\Controllers\Auth\LoginController@login');


//http://localhost:8001/logtest?name=batman&password=batman

Route::get('/home', 'HomeController@index')->name('home');
