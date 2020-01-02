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
    // load all tasks from database
    $tasks = App\Task::all();

    // inject data into the view
    return view('task.index', ['tasks' => $tasks]);
});

/**
 * complete a task
 */
Route::patch('{task}', function (App\Task $task) {
    // now task will be loaded in this variable ($task)

    $task->completed = true; // set completed column to true

    $task->update();

    return back(); // return to all tasks page
});

/**
 * Delete a task
 */
Route::delete('{task}', function (App\Task $task) {
    $task->delete();

    return back();
});

/**
 * Add new Task
 */
Route::post('/', function () {
    // validate task body
    $body = request()->validate([
        'body' => 'required|string|max:255'
    ])['body'];

    // save task
    App\Task::create([
        'body' => $body
    ]);

    // return to home page
    return back();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
