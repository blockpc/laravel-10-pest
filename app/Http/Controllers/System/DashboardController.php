<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $users = User::all();
        $online = 0;
        foreach($users as $user) {
            if($user->isOnline()) {
                $online++;
            }
        }
        return view('system.dashboard', compact('users', 'online'));
    }
}
