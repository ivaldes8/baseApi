<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LogController;

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

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('currentUser', [AuthController::class, 'getCurrentUser']);
    Route::resource('blogs', BlogController::class);
    Route::resource('users', UserController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('addLog', [LogController::class, 'addToLog']);
    Route::get('logs/{id}', [LogController::class, 'logActivityByUser']);
    Route::get('logs', [LogController::class, 'logActivity']);
});
