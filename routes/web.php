<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Halaman Beranda
Route::get('/', function () {
    return view('beranda');
});

//Halaman Daftar Siswa
Route::get('/siswa/daftar', function () {
    return view('siswa.daftar');
});

// Proses Daftar Siswa 
Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar.post');
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

// Login Siswa
Route::get('/siswa/masuk', [AuthController::class, 'showSiswaLogin'])->name('siswa.login');
Route::post('/siswa/masuk', [AuthController::class, 'siswaLoginProcess'])->name('siswa.login.submit');
Route::get('/dashboard/siswa', function () {
    return view('siswa.dashboard');
})->name('dashboard.siswa')->middleware('auth');

// Halaman Pembayaran Siswa
Route::get('/siswa/pembayaran', function () {
    return view('siswa.pembayaran');
})->name('siswa.pembayaran')->middleware('auth');

// Proses pembayaran
Route::get('/siswa/pembayaran/proses', function () {
    return view('siswa.pembayaran_proses');
})->name('siswa.pembayaran.proses')->middleware('auth');

//Logout Siswa
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Login Admin
Route::get('/admin/masuk', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/masuk', [AuthController::class, 'adminLoginProcess'])->name('admin.login.submit');
Route::get('/dashboard/admin', function () {
    return view('dashboard_admin');
})->name('dashboard.admin')->middleware('auth');