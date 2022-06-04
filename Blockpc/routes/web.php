<?php

use Blockpc\App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'online'])
    ->prefix('sistema')
    ->group(function () {
        
        Route::get('/', function () {
            return redirect(route('dashboard'));
        });

        Route::get('lista-de-tareas', TodoController::class)->name('todo');

    });