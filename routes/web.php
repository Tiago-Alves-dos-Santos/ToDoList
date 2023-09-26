<?php


use Inertia\Inertia;
use App\Helpers\RoutesHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
    RoutesHelper::tasks();
});
