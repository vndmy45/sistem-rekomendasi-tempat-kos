<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\KosController;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/',[HomeController::class, 'index']);

Route::get('/register', function () {
    return 'Halaman Register belum dibuat';
})->name('register');

Route::get('/login', function () {
    return 'Halaman Login belum dibuat';
})->name('login');

Route::get('/pencarian', [PencarianController::class, 'index'])->name('pencarian.index');
Route::get('/pencarian/filter', [PencarianController::class, 'filter'])->name('pencarian.filter');

// Kos Routes
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');
Route::post('/kos/{id}/reviews', [KosController::class, 'storeReview'])->name('reviews.store');
