<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\HomeController; 
use Illuminate\Support\Facades\Route;

// halaman beranda (daftar produk)
Route::get('/', [HomeController::class, 'index'])->name('home');

// halaman detail produk (berdasarkan slug)
Route::get('/product/{slug}', [HomeController::class, 'show'])->name('product.detail');

// authentication dari Laravel Breeze

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';