<?php

use Illuminate\Support\Facades\Route;
use Packages\Book\App\Http\Controllers\BookController;

Route::middleware([
    'web', 'auth'
])->prefix('sistema/libros')->group(function () {

    Route::get('/', [BookController::class, 'index'])->name('book.index');
});
