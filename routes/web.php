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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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
Route::get('/admin/users/group/{group}/create', 'AdminUserController@create')->name('admin.user.create');
Route::post('/admin/users/group/{group}/store', 'AdminUserController@store')->name('admin.user.store');
Route::get('/admin/users/edit/{user}', 'AdminUserController@edit')->name('admin.user.edit');
Route::patch('/admin/users/update/{user}', 'AdminUserController@update')->name('admin.user.update');

//Tasks

Route::get('/admin/tasks', 'AdminTaskController@show')->name('admin.task.show');
Route::get('/admin/tasks/create', 'AdminTaskController@create')->name('admin.task.create');
Route::post('/admin/tasks/store', 'AdminTaskController@store')->name('admin.task.store');
Route::delete('/admin/tasks/{task}', 'AdminTaskController@destroy')->name('admin.task.delete');
Route::get('/admin/tasks/edit/{task}', 'AdminTaskController@edit')->name('admin.task.edit');
Route::patch('admin/tasks/update/{task}', 'AdminTaskController@update')->name('admin.task.update');


//Slots

Route::get('/admin/slots/groups/', 'AdminSlotController@showGroups')->name('admin.slot.showGroups');
Route::get('/admin/slots/group/{group}', 'AdminSlotController@show')->name('admin.slot.show');
Route::get('/admin/slots/group/{group}/create', 'AdminSlotController@create')->name('admin.slot.create');
Route::get('admin/slots/edit/{slot}', 'AdminSlotController@edit')->name('admin.slot.edit');
Route::post('admin/slots/group/{group}/store', 'AdminSlotController@store')->name('admin.slot.store');
Route::patch('admin/slots/update/{slot}', 'AdminSlotController@update')->name('admin.slot.update');



Route::get('/meep', function () {
    return view('welcome');
});

Route::get('/task', function () {
    return view('Tasks.index');

});



//json
Route::get('/task/index', 'TaskController@index')->name('task.index');


//Route::get('/logtest', '\App\Http\Controllers\Auth\LoginController@login');




//http://localhost:8001/logtest?name=batman&password=batman

//Route::get('/home', 'HomeController@index')->name('home');
