<?php
namespace App\Helpers;

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/**
 * Rotas em comum entre dois mais users(guards)
 */
final class RoutesHelper
{
    /**
     * Rota de tarefas
     *
     * @return void
     */
    public static function tasks(): void
    {
        Route::prefix('/task')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('task.index');
            Route::get('/report', [TaskController::class, 'viewReport'])->name('task.viewReport');
            Route::post('/printPDF', [TaskController::class, 'printPDF'])->name('task.printPDF');
            Route::match(['get', 'post'], '/create', [TaskController::class, 'create'])->name('task.create');
            Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
            Route::put('/toggleStatus', [TaskController::class, 'toggleStatus'])->name('task.toggleStatus');
            Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
        });
    }
}
