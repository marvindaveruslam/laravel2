<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TryController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route publik
Route::get('/', [ContohController::class, 'index']);
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/try', [TryController::class, 'index'])->name('try');

// Route login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proseslogin'])->name('login.proses');

// Route dashboard (dilindungi auth)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route profile (dilindungi auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';