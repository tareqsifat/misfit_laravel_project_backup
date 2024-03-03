<?php

use App\Http\Controllers\Manager\ProjectController;
use App\Http\Controllers\Manager\TaskController;
use App\Http\Controllers\Manager\TeammateController;
use \App\Http\Controllers\Teammate\TeammateTaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' =>'auth'], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::controller(TeammateTaskController::class)->group(function (){
        Route::get('teammate_task_index', 'index')->name('teammate_task_index');
        Route::put('task_status_update', 'status_update')->name('task_status_update');
        Route::get('status_edit/{id}', 'status_edit')->name('status_edit');
    });
});

Route::group([
    'middleware' => ['auth','manager']
],
 function (){
     Route::resource('teammates', TeammateController::class);
     Route::resource('projects', ProjectController::class);
     Route::resource('tasks', TaskController::class);

     Route::put('assign_task_to_teammate', [TaskController::class, 'assign_task_to_teammate'])->name('assign_task_to_teammate');
 });


