<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\FriendRequestController;
use App\Http\Controllers\Website\LikeController;
use App\Http\Controllers\Website\NewfeedController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\Website\UserProfileController;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware('auth')->group(function () {
    Route::get('/news-feed',[NewfeedController::class,'index']);
    Route::get('/profile', [UserProfileController::class, 'profile']);
    Route::get('/view-profile{id}', [UserProfileController::class, 'viewProfile']);
    Route::get('/profile-edit', [UserProfileController::class, 'profileEdit']);
    Route::put('/profile', [UserProfileController::class, 'profileUpdate']);

    Route::resource('posts',PostController::class);
    Route::get('download-image/{id}',[PostController::class,'downImage']);
    Route::get('/users', [UserProfileController::class, 'getAllUsers']);

    Route::post('post-like/{id}',[LikeController::class,'likePost']);
    Route::post('post-comment/{id}',[LikeController::class,'commentPost']);

    Route::post('addFriend/{senderID}',[FriendRequestController::class,'addFriend']);
    Route::post('reject-friend/{receiver_id}',[FriendRequestController::class,'rejectFriend']);
    Route::post('accept-friend/{receiver_id}',[FriendRequestController::class,'acceptFriend']);
    Route::get('/FriendShipRequests',[FriendRequestController::class,'viewFriendshipReequests']);
    Route::get('/Friends',[UserProfileController::class,'showFriendUser']);
});


require __DIR__.'/auth.php';
