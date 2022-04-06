<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
])->group(function () {

    Route::get('/', HomeController::class)->name('home');

    Route::middleware([
        'guest'
    ])->group(function() {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware([
        'auth'
    ])->group(function($routes) {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});