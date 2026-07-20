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
Route::get('/About', [AboutController::class, 'index']);
Route::get('/Try', [TryController::class, 'index']);

// Route Login (pakai huruf besar 'L' sesuai dengan yang teman Anda buat)
Route::get('/Login', [LoginController::class, 'index'])->name('login');
Route::post('/Login', [LoginController::class, 'proseslogin'])->name('login.proses');

// Route logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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