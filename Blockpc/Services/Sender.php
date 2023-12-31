<?php

declare(strict_types=1);

namespace Blockpc\Services;

use App\Models\User;
use Blockpc\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Notification;

class Sender
{
    public function __construct()
    {
        //
    }

    public function new_todo($todo, $message)
    {
        $sudos = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        
        Notification::send($sudos, new NewUserNotification($todo, $message));
        return true;
    }
}