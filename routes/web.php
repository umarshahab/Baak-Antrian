<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN DEPAN
// Jika user membuka website utama, langsung arahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});


// 2. GROUP ROUTE YANG WAJIB LOGIN (Middleware Auth)
Route::middleware(['auth'])->group(function () {

    // --- BAGIAN MAHASISWA ---
    // URL '/mhs/dashboard' kita arahkan ke function 'index' (Tampilan Portal Kampus)
    // PENTING: name harus 'mhs.dashboard' agar sesuai dengan error yang tadi muncul
    Route::get('/mhs/dashboard', [AntrianController::class, 'index'])->name('mhs.dashboard');
    
    // Route cadangan (opsional) jika ada yang akses /ambil-antrian
    Route::get('/ambil-antrian', [AntrianController::class, 'index'])->name('ambil.antrian');

    // Route untuk tombol "Ambil Antrian" (Simpan Data)
    Route::post('/simpan', [AntrianController::class, 'store'])->name('simpan');
    // Route Halaman Kontak
    Route::get('/kontak', [AntrianController::class, 'kontak'])->name('kontak');

    // --- BAGIAN PETUGAS ---
    // Dashboard Petugas (Tabel Antrian)
    Route::get('/dashboard', [AntrianController::class, 'dashboard'])->name('dashboard');
    
    // Tombol Panggil / Selesai
    Route::put('/update/{id}', [AntrianController::class, 'update'])->name('update');

});


// 3. ROUTE OTENTIKASI BAWAAN (Login, Register, Logout)
// SANGAT PENTING: Baris ini memanggil file auth.php bawaan Laravel Breeze.
require __DIR__.'/auth.php';