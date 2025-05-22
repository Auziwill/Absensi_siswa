<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gurucontroller;
use App\Http\Controllers\ortucontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\absencontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\lokalcontroller;
use App\Http\Controllers\rekapcontroller;
use App\Http\Controllers\siswacontroller;
use App\Http\Controllers\jurusancontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\pengajuancontroller;
use App\Http\Controllers\walikelascontroller;


Route::post('/proseslogin', [LoginController::class, 'authentication'])->name('login');
Route::get('/', [LoginController::class, 'view'])->name('login-view');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::fallback(function () {
    return response()->view('template_admin.eror', [], 404);
});


Route::middleware('auth')->group(function () {
Route::get('/latihan', [siswacontroller::class, 'index'])->name('latihan');

Route::get('/dashboardAdmin', [dashboardcontroller::class, 'dashboardAdmin'])->name('dashboard.admin');
Route::resource('siswa', siswacontroller::class);
Route::resource('guru', gurucontroller::class);
Route::resource('lokal', lokalcontroller::class);
Route::get('/lokal/create', [lokalController::class, 'create'])->name('lokal.create');
Route::get('/lokal/{id}/edit', [lokalController::class, 'edit'])->name('lokal.edit');
Route::put('/lokal/{id}', [lokalController::class, 'update'])->name('lokal.update');
Route::delete('/lokal/{id}', [lokalController::class, 'destroy'])->name('lokal.destroy');
Route::get('/lokal/{id}', [lokalController::class, 'show'])->name('lokal.show');
Route::post('/lokal/store', [lokalController::class, 'store'])->name('lokal.store');
Route::resource('jurusan', jurusancontroller::class);
Route::resource('walikelas', walikelascontroller::class);
Route::resource('ortu', ortucontroller::class);
Route::resource('user', usercontroller::class);


Route::get('/dashboardGuru', [dashboardcontroller::class, 'dashboardGuru'])->name('dashboard.guru');
Route::get('/absen', [absencontroller::class, 'index'])->name('absen.index');
Route::get('/absen/create', [absencontroller::class, 'create'])->name('absen.create');
Route::post('/absen/store', [absencontroller::class, 'store'])->name('absen.store');
Route::get('absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
Route::put('absen/{id}', [AbsenController::class, 'update'])->name('absen.update');
Route::get('/absen/riwayat', [AbsenController::class, 'riwayat'])->name('absen.riwayat');
Route::post('/absen/update-status', [absencontroller::class, 'updateStatus'])->name('absen.updateStatus');
Route::post('/absen/laporan-bulanan', [AbsenController::class, 'laporanBulanan'])->name('absen.laporanBulanan');



Route::get('/dashboardSiswa', [dashboardcontroller::class, 'dashboardSiswa'])->name('dashboard.siswa');
Route::resource('rekap', rekapcontroller::class);
Route::resource('pengajuan', pengajuancontroller::class);




Route::get('/dashboardWalikelas', [dashboardcontroller::class, 'dashboardWalikelas'])->name('dashboard.walikelas');
Route::get('absenWalikelas', [AbsenController::class, 'indexWalikelas'])->name('absenWalikelas.index');
Route::post('/absenWalikelas/store', [absencontroller::class, 'storeWalikelas'])->name('absenWalikelas.store');
Route::get('absenWalikelas/create', [AbsenController::class, 'createWalikelas'])->name('absenWalikelas.create');
Route::post('absenWalikelas/membuat', [AbsenController::class, 'membuat'])->name('absenWalikelas.membuat');
Route::get('absenWalikelas/{id}/edit', [AbsenController::class, 'editWalikelas'])->name('absenWalikelas.edit');
Route::put('absenWalikelas/{id}', [AbsenController::class, 'updateWalikelas'])->name('absenWalikelas.update');
Route::get('absenWalikelas/riwayat', [AbsenController::class, 'riwayatWalikelas'])->name('absenWalikelas.riwayat');
Route::get('/riwayat-bulanan', [AbsenController::class, 'laporanBulanan'])->name('riwayat.bulanan');


Route::get('/validasi', [pengajuancontroller::class, 'index3'])->name('pengajuan.index3');
Route::put('pengajuan/{id}/updateStatus', [pengajuancontroller::class, 'updateStatus'])->name('pengajuan.updateStatus');

Route::get('ditolak',function(){
    return view('dilarang');
})->name('dilarang');


});