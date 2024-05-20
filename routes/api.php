<?php

use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ConnectionController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/register', [AuthTokenController::class, 'sign_up']);
Route::post('/login', [AuthTokenController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthTokenController::class, 'logout']);
    Route::apiResource('user-profiles', UserProfileController::class);

    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments-posts', CommentController::class);
    Route::apiResource('liks-posts', LikeController::class);
    Route::apiResource('liks-posts', LikeController::class);
    
    Route::apiResource('connections', ConnectionController::class);

});
