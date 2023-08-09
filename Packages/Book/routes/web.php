<?php

use Illuminate\Support\Facades\Route;
use Packages\Book\App\Http\Controllers\BookController;

Route::middleware([
    'web', 'auth'
])->prefix('sistema/books')->controller(BookController::class)->group(function () {

    Route::get('/', 'index')->name('book.index');
    Route::get('/create', 'create')->name('book.create');
    Route::post('/create', 'store')->name('book.store');
    Route::get('/edit/{book}', 'edit')->name('book.edit');
    Route::post('/edit/{book}', 'update')->name('book.update');
});
