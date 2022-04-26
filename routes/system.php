<?php

declare(strict_types=1);

use App\Http\Controllers\System\DashboardController;
use App\Http\Controllers\System\PermissionsController;
use App\Http\Controllers\System\ProfileController;
use App\Http\Controllers\System\RolesController;
use App\Http\Controllers\System\TodoController;
use App\Http\Controllers\System\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'online'])
    ->prefix('sistema')
    ->group(function () {
        
        Route::get('/', function () {
            return redirect(route('dashboard'));
        });

        Route::get('lista-de-tareas', TodoController::class)->name('todo');

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('/perfil-usuario', ProfileController::class)->name('profile');

        Route::resource('/users', UsersController::class)->only([
            'index', 'create', 'edit'
        ]);

        Route::resource('/roles', RolesController::class)->only([
            'index', 'create', 'edit'
        ]);

        Route::get('/permisos', PermissionsController::class)
            ->name('permissions.index');
});