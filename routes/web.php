<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\KosController;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/',[HomeController::class, 'index']);

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/pencarian', [PencarianController::class, 'index'])->name('pencarian.index');
Route::get('/pencarian/filter', [PencarianController::class, 'filter'])->name('pencarian.filter');

// Kos Routes
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');
Route::post('/kos/{id}/reviews', [KosController::class, 'storeReview'])->name('reviews.store');
