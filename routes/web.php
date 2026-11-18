<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Manajemen pengguna: hanya admin
    Route::middleware('role:admin')->resource('users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy']);

    // Materi: semua role boleh melihat; admin & dosen mengelola
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::middleware('role:admin,dosen')->group(function () {
        Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
        Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');

        // Nilai: admin & dosen mengelola
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/create', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    });

    // Mahasiswa: lihat nilai sendiri
    Route::get('/nilai-saya', [NilaiController::class, 'saya'])->middleware('role:mahasiswa')->name('nilai.saya');
});
