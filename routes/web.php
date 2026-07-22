<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ContohController::class, 'index']);
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/try', [TryController::class, 'index'])->name('try');


Route::get('j-login', [LoginController::class, 'index'])->name('Login');

Route::get('artikel', [ArtikelController::class, 'index']);
Route::get('kategori', [KategoriController::class, 'index']);
Route::get('komentar', [KomentarController::class, 'index']);



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
