<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');

Route::get('/create-task', [App\Http\Controllers\TaskController::class, 'createTask'])->name('createTask');

Route::get('/edit-task/{id}', [App\Http\Controllers\TaskController::class, 'editTask'])->name('editTask');

Route::post('/process-add-task', [App\Http\Controllers\TaskController::class, 'addTask'])->name('processTask');

Route::put('/process-update-task/{id}', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('updateTask');

Route::post('/task-sortable', [App\Http\Controllers\TaskController::class, 'update'])->name('update');

Route::delete('/remove-task/{id}', [App\Http\Controllers\TaskController::class, 'removeTask'])->name('removeTask');

});
