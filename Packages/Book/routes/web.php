<?php

use Illuminate\Support\Facades\Route;
use Packages\Book\App\Http\Controllers\BookController;

Route::middleware([
    'web', 'auth'
])->prefix('sistema/books')->group(function () {

    Route::get('/', [BookController::class, 'index'])->name('book.index');
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/create', [BookController::class, 'store'])->name('book.store');
});
