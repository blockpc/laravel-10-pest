<?php

declare(strict_types=1);

use App\Http\Controllers\System\DashboardController;
use App\Http\Controllers\System\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('sistema')
    ->group(function () {
        
        Route::get('/', function () {
            return redirect(route('dashboard'));
        });

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('/perfil-usuario', ProfileController::class)->name('profile');
});