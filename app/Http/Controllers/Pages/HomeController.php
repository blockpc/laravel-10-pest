<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

final class HomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.home');
    }
}