<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class FriendController extends Controller
{
    public function index(Request $request)
    {
        return view('book::friends.index', [
            'pendingFriendOfMines' => $request->user()->pendingFriendOfMine,
            'pendingFriendOfs' => $request->user()->pendingFriendOf,
            'acceptedFriendOfMines' => $request->user()->acceptedFriendOfMine,
        ]);
    }

    public function add()
    {
        return view('book::friends.add');
    }
}
