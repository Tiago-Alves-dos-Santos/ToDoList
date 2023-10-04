<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
//não configurada em 'config/app'
final class RoutesHelper
{
    public static function tasks(): void
    {
        Route::prefix('/task')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('task.index');
            Route::get('/report', [TaskController::class, 'viewReport'])->name('task.viewReport');
            Route::match(['get', 'post'], '/create', [TaskController::class, 'create'])->name('task.create');
            Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
            Route::put('/toggleStatus', [TaskController::class, 'toggleStatus'])->name('task.toggleStatus');
            Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
        });
    }
}
