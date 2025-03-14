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
        Route::post('/batch-list', [ApplicationController::class, 'batch_list'])->name('api_application_batch_list');
        Route::post('/process', [ApplicationController::class, 'process'])->name('api_application_process');
        Route::post('/invite', [ApplicationController::class, 'invite'])->name('api_application_invite');
        Route::post('/batch-invite', [ApplicationController::class, 'batch_invite'])->name('api_application_batch_invite');
        Route::post('/download', [ApplicationController::class, 'download'])->name('api_application_download');
        Route::post('/download_pdf', [ApplicationController::class, 'download_pdf'])->name('api_application_download_pdf');
    });

    Route::group(['prefix' => 'profile'], function() {
        Route::post('/update', [UserController::class, 'profile_update'])->name('api_profile_update');
    });
});