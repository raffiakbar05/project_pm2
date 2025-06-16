<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', [ArtikelController::class, 'index'])->name('beranda');
Route::prefix('article')->name('articles.')->group(function(){
    Route::get('/', [ArtikelController::class, 'm'])->name('index');
    Route::post('/post', [ArtikelController::class, 'store'])->name('store');
    Route::get('/create', [ArtikelController::class, 'create'])->name('create');
});

Route::middleware(['auth', 'admin'])->group(function(){
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{article}', [AdminController::class, 'show'])->name('show');
        Route::get('/{article}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{article}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{article}', [AdminController::class, 'destroy'])->name('destroy');
});
});
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
