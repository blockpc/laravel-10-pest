<?php

use App\Http\Controllers\Dev\DevelopmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'dev', 'auth'])
    ->prefix('development')
    ->group(function () {

    Route::get('/', [DevelopmentController::class, 'index'])->name('dev.index');
    Route::get('/user-notification', [DevelopmentController::class, 'user_notification'])->name('dev.notification');
});