<?php

use App\Helpers\RoutesHelper;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('/profile', [UserController::class, 'viewProfile'])->name('admin.viewProfile');
    Route::get('/list', [AdminController::class, 'viewAdmins'])->name('admin.viewAdmins');
    Route::get('new/register', [AdminController::class, 'viewRegister'])->name('admin.viewRegister');
    Route::post('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::prefix('users')->group(function() {
        Route::get('/', [AdminUserController::class,'viewListUsers'])->name('admin.viewListUsers');
        Route::patch('/disable/2fa/{id}', [AdminUserController::class,'disable2FAUser'])->name('admin.disable2FAUser');
        Route::patch('/toggleActive/{id}', [AdminUserController::class,'toggleActive'])->name('admin.toggleActive');
    });
    if(request()->isAdmin()){
        RoutesHelper::tasks();
    }
});




