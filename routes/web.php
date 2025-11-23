<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;

// Halaman awal langsung minta Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup Route yang WAJIB LOGIN
Route::middleware(['auth'])->group(function () {
    
    // Halaman Mahasiswa
    Route::get('/home', [AntrianController::class, 'index'])->name('home');
    Route::post('/simpan', [AntrianController::class, 'store'])->name('simpan');

    // Halaman Petugas
    Route::get('/dashboard', [AntrianController::class, 'dashboard'])->name('dashboard');
    Route::put('/update/{id}', [AntrianController::class, 'update'])->name('update');
});

require __DIR__.'/auth.php';