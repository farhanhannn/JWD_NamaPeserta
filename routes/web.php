<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/katalog', [ProductController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [ProductController::class, 'show'])->name('katalog.detail');

// Route Kelola Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ProductController::class, 'admin'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
});