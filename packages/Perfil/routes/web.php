<?php

use Illuminate\Support\Facades\Route;
use Packages\Perfil\App\Http\Controllers\PerfilController;

Route::middleware([
    'web',
])->prefix('perfil')->group(function () {

    Route::get('/', [PerfilController::class, 'index'])->name('perfil.index');
    Route::get('/create', [PerfilController::class, 'create'])->name('perfil.create');
});