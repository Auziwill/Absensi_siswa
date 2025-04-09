<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gurucontroller;
use App\Http\Controllers\ortucontroller;
use App\Http\Controllers\absencontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\lokalcontroller;
use App\Http\Controllers\siswacontroller;
use App\Http\Controllers\jurusancontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\walikelascontroller;




Route::view('/', 'utama.login');

Route::get('/dashboardAdmin', [dashboardcontroller::class, 'dashboardAdmin'])->name('dashboard.admin');


Route::get('/latihan', [siswacontroller::class, 'index'])->name('latihan');

Route::fallback(function () {
    return response()->view('template_admin.eror', [], 404);
});

Route::get('/register', function () {
    return view('utama.register');
})->name('register');



Route::resource('siswa', siswacontroller::class);
Route::get('/dashboardGuru', [dashboardcontroller::class, 'dashboardGuru'])->name('dashboard.guru');

Route::resource('guru', gurucontroller::class);
Route::resource('lokal',lokalcontroller ::class);
Route::resource('jurusan', jurusancontroller::class);
Route::resource('walikelas', walikelascontroller::class);
Route::resource('ortu', ortucontroller::class);
 
Route::post('/auth',[LoginController::class,'authentication'])->name('login');
Route::get('/login',[LoginController::class,'view'])->name('login-view');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/welcome', function () {
    return view('guru.index', 
    ['menu' => 'welcome']);
})->name('welcome');

Route::resource('absen', absencontroller::class);