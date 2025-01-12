<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('verify-email', [UserController::class, 'verifyEmail']);
Route::post('resend-otp', [UserController::class, 'resendOtp']);

Route::post('login', [UserController::class, 'login']);
Route::post('test-mailer', [UserController::class, 'send_email']);


Route::middleware(['auth:sanctum', 'current_user'])->group(function() {
    Route::get('logout', [UserController::class, 'logout'])->name('api_logout_logout');

    Route::group(['prefix' => 'document'], function() {
        Route::post('/upload', [DocumentController::class, 'upload'])->name('api_upload_document');
        Route::post('/remove', [DocumentController::class, 'remove'])->name('api_remove_document');
    });

    Route::group(['prefix' => 'applications'], function() {
        Route::post('/list', [ApplicationController::class, 'list'])->name('api_application_list');
        Route::post('/process', [ApplicationController::class, 'process'])->name('api_application_list');
    });

    Route::group(['prefix' => 'profile'], function() {
        Route::post('/update', [UserController::class, 'profile_update'])->name('api_profile_update');
    });
});