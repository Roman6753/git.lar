<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('cards', CardController::class)->except(['show', 'edit', 'update']);
});


Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::patch('/cards/{card}/approve', [AdminController::class, 'approve'])->name('admin.cards.approve');
    Route::patch('/cards/{card}/reject', [AdminController::class, 'reject'])->name('admin.cards.reject');
});