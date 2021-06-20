<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Version 1
Route::prefix('v1')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // auth routes
    Route::middleware('auth:api')->group(function(){
        Route::apiResource('tasks', TaskController::class);

        // api/v1/me - retorna os dados do usuário logado
        Route::get('me', [AuthController::class, 'me']);

        // api/v1/refresh - atualiza o token do usuário
        Route::get('refresh', [AuthController::class, 'refresh']);

        // api/v1/logout - efetua o logout
        Route::get('logout', [AuthController::class, 'logout']);

        // api/v1/invalidate - efetua o logout e invalida o token 
        Route::get('invalidate', [AuthController::class, 'invalidate']);
    });
});