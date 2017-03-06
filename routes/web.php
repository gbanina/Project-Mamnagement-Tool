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
    if (Auth::guest())
        return view('landing');
    else
        return Redirect::to('board');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home', 'HomeController@index');

    Route::resource('project', 'Project\ProjectController');
    Route::resource('task', 'TaskController');
    Route::resource('users', 'UsersController');

    Route::resource('type', 'Task\TypeController');
    Route::resource('status', 'Task\StatusController');
    Route::resource('prioritry', 'Task\PriorityController');

    Route::resource('help', 'HelpController');
    Route::resource('settings', 'SettingsController');
    Route::resource('profile', 'ProfileController');

    Route::resource('admin/role', 'Admin\RoleController');
    Route::resource('admin/task-type', 'Admin\TaskTypeController');
    Route::resource('admin/project-type', 'Admin\ProjectTypeController');
    Route::resource('admin/status', 'Admin\StatusController');
    Route::resource('admin/priority', 'Admin\PriorityController');
    Route::resource('admin/field', 'Admin\TaskFieldController');

    Route::resource('board', 'BoardController');
    Route::resource('work', 'Work\WorkController');
    Route::resource('account', 'AccountController');

    Route::get('switch/{id}', 'AccountChaingeController@switchTo');
});
