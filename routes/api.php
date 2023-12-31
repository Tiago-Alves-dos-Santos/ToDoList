<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    return json_encode($request->user());
});


Route::prefix('admin')->group(function() {
    Route::post('/login', [ApiAdminController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/list/users', [ApiAdminController::class, 'listUsers']);
        Route::get('/list/admins', [ApiAdminController::class, 'listAdmins']);
        Route::post('/revoke', [ApiAdminController::class, 'revoke']);
    });

});
