<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AspirationController as AdminAspiration;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\AspirationController as SiswaAspiration;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/aspirasi', [AdminAspiration::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspiration}', [AdminAspiration::class, 'show'])->name('aspirasi.show');
    Route::patch('/aspirasi/{aspiration}/status', [AdminAspiration::class, 'updateStatus'])->name('aspirasi.status');
    Route::post('/aspirasi/{aspiration}/feedback', [AdminAspiration::class, 'storeFeedback'])->name('aspirasi.feedback');
    Route::post('/aspirasi/{aspiration}/progress', [AdminAspiration::class, 'storeProgress'])->name('aspirasi.progress');

    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [CategoryController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [CategoryController::class, 'destroy'])->name('kategori.destroy');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    Route::get('/aspirasi', [SiswaAspiration::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [SiswaAspiration::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [SiswaAspiration::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{aspirasi}', [SiswaAspiration::class, 'show'])->name('aspirasi.show');
});
