<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;

final class BookController extends Controller
{
    public function index()
    {
        return view('book::index');
    }
}