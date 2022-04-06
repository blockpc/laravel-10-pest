<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('sistema')
    ->group(function () {
        
        Route::get('/', function () {
            return redirect(route('dashboard'));
        });

        Route::get('dashboard')->name('dashboard');
});