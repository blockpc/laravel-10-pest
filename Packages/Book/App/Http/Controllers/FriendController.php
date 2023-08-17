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
        $user = $request->user();

        return view('book::friends.index', [
            'pendingFriendOfMines' => $user->pendingFriendOfMine,
            'pendingFriendOfs' => $user->pendingFriendOf,
            'acceptedFriendOfMines' => $user->acceptedFriendOfMine,
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

    public function accept(Request $request, User $friend)
    {
        $request->user()->acceptFriend($friend);

        return redirect(route('friend.index'))->with('success', 'A friend was accepted');
    }

    public function cancel(Request $request, User $friend)
    {
        $request->user()->removeFriend($friend);

        return redirect(route('friend.index'))->with('info', 'A request was cancel');
    }

    public function remove(Request $request, User $friend)
    {
        $request->user()->removeFriend($friend);

        return redirect(route('friend.index'))->with('info', 'A friend was remove');
    }
}
