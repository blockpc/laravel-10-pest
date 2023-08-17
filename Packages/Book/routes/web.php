<?php

use Illuminate\Support\Facades\Route;
use Packages\Book\App\Http\Controllers\BookController;
use Packages\Book\App\Http\Controllers\FriendController;

Route::middleware([
    'web', 'auth'
])->prefix('sistema/books')->controller(BookController::class)->group(function () {

    Route::get('/', 'index')->name('book.index');
    Route::get('/create', 'create')->name('book.create');
    Route::post('/create', 'store')->name('book.store');
    Route::get('/edit/{book}', 'edit')->name('book.edit');
    Route::put('/edit/{book}', 'update')->name('book.update');
});

Route::middleware([
    'web', 'auth'
])->prefix('sistema/friends')->controller(FriendController::class)->group(function () {

    Route::get('/', 'index')->name('friend.index');
    Route::get('/add-a-friend', 'add')->name('friend.add');
    Route::post('/add-a-friend', 'store')->name('friend.store');
    Route::put('/accept-a-friend/{friend}', 'accept')->name('friend.accept');
    Route::delete('/cancel-a-friend/{friend}', 'cancel')->name('friend.cancel');
    Route::delete('/remove-a-friend/{friend}', 'remove')->name('friend.remove');
});
