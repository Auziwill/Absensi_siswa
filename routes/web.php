<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('pages-login');
});
Route::get('/register', function () {
    return view('pages-register');
});


