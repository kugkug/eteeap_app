<?php

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
});