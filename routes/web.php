<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Halaman awal → selalu redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Routes khusus mahasiswa (pakai middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/mhs/dashboard', [AntrianController::class, 'dashboardMhs'])->name('mhs.dashboard');
    Route::get('/ambil-antrian', [AntrianController::class, 'index'])->name('ambil.antrian');
    Route::post('/simpan', [AntrianController::class, 'store'])->name('simpan');
});

// Routes khusus petugas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AntrianController::class, 'dashboard'])->name('dashboard');
    Route::put('/update/{id}', [AntrianController::class, 'update'])->name('update');
});
 