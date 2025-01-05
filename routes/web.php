<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LaporanController;

// Route untuk login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Rute untuk registrasi
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/informasi', [AuthController::class, 'informasi'])->name('informasi');
Route::post('/tambah-pengguna', [AuthController::class, 'storeUser'])->name('tambah-pengguna.store');
// Rute untuk halaman dashboard admin
Route::get('/admin-dashboard', function () {
    return view('admin.dashboard'); // Ganti dengan nama view dashboard admin Anda
})->name('admin_dashboard');
// Route untuk beranda
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

// Rute untuk halaman informasi
Route::get('/informasi', [AuthController::class,'informasi'])->name('informasi');
// Rute untuk halaman input bahan
Route::get('/input_bahan', [BahanController::class, 'showInputForm'])->name('input_bahan');
// Rute untuk menyimpan data bahan
Route::post('/input_bahan', [BahanController::class, 'store'])->name('input_bahan.store');
// Rute untuk halaman stok
Route::get('/stok', [BahanController::class, 'showStock'])->name('stok');
// Rute untuk halaman order bahan
Route::get('/order_bahan', [OrderController::class, 'showOrderForm'])->name('order_bahan');
// Tambahkan route berikut
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
// Rute untuk halaman laporan
Route::get('/laporan', [LaporanController::class, 'showLaporanForm'])->name('laporan');
// Rute untuk menyimpan data pengguna baru
Route::post('/tambah-pengguna', [AuthController::class, 'storeUser'])->name('tambah-pengguna.store');
// Tambahkan route untuk laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
