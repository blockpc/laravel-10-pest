<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;

final class FriendController extends Controller
{
    public function index()
    {
        return view('book::friends.index');
    }
}
