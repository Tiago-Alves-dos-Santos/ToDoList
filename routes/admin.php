<?php

use App\Helpers\RoutesHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


Route::prefix('/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('admin.viewProfile');
    if(request()->isAdmin()){
        RoutesHelper::tasks();
    }
});




