<?php

use Blockpc\App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['dev'])
    ->prefix('sistema')
    ->group(function () {
        /**
         * Routes for test some new features
        */
        
    });