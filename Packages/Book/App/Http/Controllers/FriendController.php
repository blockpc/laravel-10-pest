<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', Rule::exists('users', 'email'), Rule::notIn($request->user()->email)]
        ]);

        $friend = User::where('email', $request->email)->first();

        $request->user()->addFriend($friend);

        return redirect(route('friend.index'))->with('success', 'A friend was requested');
    }
}
