<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobtask;
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
Route::resource('/jobtask2', Jobtask::class);
Route::get('/admin', function () {
    return view('admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/myjob/task1', [App\Http\Controllers\HomeController::class, 'task1']);
Route::get('/myjob/task2', [App\Http\Controllers\HomeController::class, 'task2']);
Route::get('/myjob/task3', [App\Http\Controllers\HomeController::class, 'task3']);
Route::get('/myjob/task4', [App\Http\Controllers\HomeController::class, 'task4']);
Route::get('/myjob/task5', [App\Http\Controllers\HomeController::class, 'task5']);


// note: run command php artisan route:clear to change in this file
