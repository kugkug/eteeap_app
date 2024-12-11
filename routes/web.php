<?php

use App\Http\Controllers\ExecApplicantController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/registration', function () {
    return view('pages.registration');
});

Route::get('/profile', function () {
    return view('pages.profile');
});

Route::group(['prefix' => 'execute'], function() {
    Route::group(['prefix' => 'applicants'], function() {
        Route::post('/save', [ExecApplicantController::class, 'save'])->name('applicants_save');
        Route::post('/list', [ExecApplicantController::class, 'list'])->name('agents_list');
    });
});