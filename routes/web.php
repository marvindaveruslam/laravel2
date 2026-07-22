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

Route::get('/', [ContohController::class, 'index'])->name('beranda');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/try', [TryController::class, 'index'])->name('try');


Route::get('j-login', [LoginController::class, 'index'])->name('Login');

Route::get('artikel', [ArtikelController::class, 'index'])
    ->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])
    ->name('artikel.show');
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('komentar', [KomentarController::class, 'index'])->name('komentar.index');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/artikel/create', [ArtikelController::class,'create'])
        ->name('artikel.create');

    Route::post('/artikel', [ArtikelController::class,'store'])
        ->name('artikel.store');

    Route::get('/artikel/{artikel}/edit', [ArtikelController::class,'edit'])
        ->name('artikel.edit');


    Route::put('/artikel/{artikel}', [ArtikelController::class,'update'])
        ->name('artikel.update');

    Route::delete('/artikel/{artikel}', [ArtikelController::class,'destroy'])
        ->name('artikel.destroy');

    Route::post('/komentar', [KomentarController::class,'store'])
        ->name('komentar.store');

    Route::delete('/komentar/{komentar}', [KomentarController::class,'destroy'])
        ->name('komentar.destroy');
});

require __DIR__.'/auth.php';
