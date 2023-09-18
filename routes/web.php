<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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
//auth_fortify
Route::get('/', function(){
    // $routes_fortify = (object)routesFortify();
    // return redirect($routes_fortify->login);
})->name('index');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
Route::prefix("/user")->group(function(){
    Route::get('/', [UserController::class, 'viewProfile'])->middleware(['auth','verified'])->name('user.viewProfile');
    Route::get('/', [UserController::class, 'viewProfile'])->middleware(['auth','verified'])->name('user.viewProfile');
});
Route::prefix("/task")->group(function(){
    Route::get('/', [TaskController::class, 'index'])->middleware(['auth','verified'])->name('task.index');
});



