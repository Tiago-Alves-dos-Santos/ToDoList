<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
   return Inertia::render('Index');
})->name('index');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
Route::prefix("/user")->group(function(){
    Route::get('/', [UserController::class, 'viewProfile'])->middleware(['auth','verified'])->name('user.viewProfile');
});


Route::prefix('task')->middleware(['auth','verified'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('task.index');
    Route::match(['get','post'],'/create', [TaskController::class, 'create'])->name('task.create');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
});


