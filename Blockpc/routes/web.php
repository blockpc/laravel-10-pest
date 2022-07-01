<?php

use Blockpc\App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web', 'auth', 'online'
])
    ->prefix('sistema')
    ->group(function () {
        Route::get('lista-de-tareas', TodoController::class)->name('todo');
    });