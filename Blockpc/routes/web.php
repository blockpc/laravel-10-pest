<?php

use Blockpc\App\Http\Controllers\TestController;
use Blockpc\App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web', 'auth', 'online'
])
    ->prefix('sistema')
    ->group(function () {
        Route::get('lista-de-tareas', TodoController::class)->name('todo');
    });

Route::middleware(['dev'])
    ->prefix('sistema')
    ->group(function () {
        /**
         * Routes for test some new features
        */
        Route::get('create-notification', [TestController::class, 'create_notification'])
            ->name('create-notification');
    });