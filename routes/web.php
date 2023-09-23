<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::prefix("/user")->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'homeUser'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('user.viewProfile');
});

function taskRoutes()
{
    Route::prefix('task')->middleware(['verified'])->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('task.index');
        Route::match(['get', 'post'], '/create', [TaskController::class, 'create'])->name('task.create');
        Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::put('/toggleStatus', [TaskController::class, 'toggleStatus'])->name('task.toggleStatus');
        Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    });
}

taskRoutes();


Route::prefix('/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('admin.viewProfile');
    taskRoutes();
});

// require 'admin.php';
