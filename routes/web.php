<?php

use App\Http\Controllers\ExecApplicantController;
use App\Http\Controllers\ExecDocumentController;
use App\Http\Controllers\ExecOtpController;
use App\Http\Controllers\ModulesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ModulesController::class, 'login'])->name('login');
Route::get('/registration', [ModulesController::class, 'registration'])->name('registration');
Route::get('/verify-email', [ModulesController::class, 'verify_email'])->name('verify_email');


Route::middleware(['auth:sanctum', 'current_user'])->group(function() {
    Route::get('/dashboard', [ModulesController::class, 'dashboard'])->name('dashboard');
    Route::get('/uploads', [ModulesController::class, 'documents'])->name('documents');
    Route::get('/education', [ModulesController::class, 'education'])->name('education');
    Route::get('/experience', [ModulesController::class, 'experience'])->name('experience');
    Route::get('/messages', [ModulesController::class, 'messages'])->name('messages');
    Route::get('/timeline', [ModulesController::class, 'timeline'])->name('timeline');
    Route::get('/information', [ModulesController::class, 'information'])->name('information');

    Route::group(['prefix' => 'execute'], function() {
        Route::group(['prefix' => 'applicants'], function() {
            Route::get('logout', [ExecApplicantController::class, 'logout'])->name('web_execute_logout');
        });

        Route::group(['prefix' => 'document'], function() {
            Route::post('/upload', [ExecDocumentController::class, 'upload'])->name('exec_upload_document');
        });
    });
});


Route::group(['prefix' => 'execute'], function() {
    Route::group(['prefix' => 'applicants'], function() {
        Route::post('save', [ExecApplicantController::class, 'save'])->name('applicants_save');
        Route::post('list', [ExecApplicantController::class, 'list'])->name('agents_list');
    });

    Route::group(['prefix' => 'otp'], function() {
        Route::post('/verify-email', [ExecOtpController::class, 'verify_email'])->name('exec_verify_email');
    });


    Route::post('login', [ExecApplicantController::class, 'login'])->name('web_execute_login');
});