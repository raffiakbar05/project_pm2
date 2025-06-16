<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [ArtikelController::class, 'index'])->name('beranda');

// CRUD Artikel
Route::resource('article', ArtikelController::class);

// Halaman dashboard (hanya untuk user yang login dan terverifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil user (dalam grup middleware auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// (Opsional) Logout ke halaman khusus
Route::get('/logout-beranda', function () {
    return view('logout_beranda');
})->name('logout.beranda');

// Auth bawaan Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';
