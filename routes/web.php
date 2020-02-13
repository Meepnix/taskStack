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

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



/* Admin */

//Dashboard
Route::get('/', 'AdminDashboardController@show')->name('admin.dashboard.show');



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
Route::get('/admin/slots/edit/{slot}', 'AdminSlotController@edit')->name('admin.slot.edit');
Route::post('/admin/slots/group/{group}/store', 'AdminSlotController@store')->name('admin.slot.store');
Route::patch('/admin/slots/update/{slot}', 'AdminSlotController@update')->name('admin.slot.update');
Route::delete('/admin/slots/{slot}', 'AdminSlotController@destroyPartial')->name('admin.slot.delete');

//Messages
Route::get('/admin/messages/groups/', 'AdminMessageController@showGroups')->name('admin.message.showGroups');
Route::get('/admin/messages/group/{group}/edit/', 'AdminMessageController@edit')->name('admin.message.edit');
Route::patch('/admin/messages/update/{message}', 'AdminMessageController@update')->name('admin.message.update');


//Locations
Route::get('/admin/locations', 'AdminLocationController@show')->name('admin.location.show');
Route::get('/admin/locations/create', 'AdminLocationController@create')->name('admin.location.create');
Route::post('/admin/locations/store', 'AdminLocationController@store')->name('admin.location.store');
Route::delete('/admin/locations/{location}', 'AdminLocationController@destroy')->name('admin.location.delete');
Route::get('/admin/locations/edit/{location}', 'AdminLocationController@edit')->name('admin.location.edit');
Route::patch('/admin/locations/update/{location}', 'AdminLocationController@update')->name('admin.location.update');

//Files
Route::get('/admin/files/location/{location}/create', 'AdminFileController@create')->name('admin.file.create');
Route::post('/admin/files/location/{location}/store', 'AdminFileController@store')->name('admin.file.store');
Route::delete('/admin/files/{file}', 'AdminFileController@destroy')->name('admin.file.delete');

//Images
Route::get('/admin/images/location/{location}/create', 'AdminImageController@create')->name('admin.image.create');
Route::post('/admin/images/location/{location}/store', 'AdminImageController@store')->name('admin.image.store');
Route::delete('/admin/images/{image}', 'AdminImageController@destroy')->name('admin.image.delete');


//Labels
Route::get('/admin/labels', 'AdminLabelController@show')->name('admin.label.show');
Route::get('/admin/labels/create', 'AdminLabelController@create')->name('admin.label.create');
Route::delete('/admin/labels/{label}', 'AdminLabelController@destroy')->name('admin.label.delete');
Route::post('/admin/labels/store', 'AdminLabelController@store')->name('admin.label.store');
Route::get('/admin/labels/edit/{label}', 'AdminLabelController@edit')->name('admin.label.edit');
Route::patch('/admin/labels/update/{label}', 'AdminLabelController@update')->name('admin.label.update');


Route::get('/task', function () {
    return view('tasks.index');

});


//json

//Messages
Route::get('/message/index', 'MessageController@index')->name('message.index');

//Tasks
Route::get('/task/index', 'TaskController@index')->name('task.index');
Route::get('/task/morning', 'TaskController@morning')->name('task.morning');
Route::get('/task/afternoon', 'TaskController@afternoon')->name('task.afternoon');
Route::get('/task/evening', 'TaskController@evening')->name('task.evening');

//Locations images
Route::get('/admin/location/index/images', 'AdminLocationController@indexImages')->name('admin.location.image.index');

//Locations files
Route::get('/admin/location/index/files', 'AdminLocationController@indexFiles')->name('admin.location.file.index');

//Tasks links
Route::get('/admin/tasks/links/{task}', 'AdminTaskController@editLinks')->name('admin.task.links');

//Tasks with labels
Route::get('/admin/tasks/task/{task}', 'AdminTaskController@editTasks')->name('admin.task.tasks');

/* Errors */
Route::get('403', function (){

    return view('errors.403');

})->name('errors.403');

/* User */

//Tasks
Route::get('/task/show', 'TaskController@show')->name('task.show');

Route::get('/logtest', '\App\Http\Controllers\Auth\LoginController@login');


//http://localhost/logtest?name=Batman&password=Batman&remember=On

//Route::get('/home', 'HomeController@index')->name('home');
