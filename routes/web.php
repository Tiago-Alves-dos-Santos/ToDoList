<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
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
// Route::get('/', function(){
//     return redirect()->route('register');
// })->name('home_i');
Route::get('/', [TaskController::class, 'index'])->name('index');
Route::get('/home', function(){
    return Inertia::render('Teste');
})->middleware('auth')->name('home');

Route::get('/email', function(){
    return view('email.verify_email');
});
