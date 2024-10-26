<?php

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