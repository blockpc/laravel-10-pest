<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Blockpc\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

final class DevelopmentController extends Controller
{
    public function index()
    {
        return true;
    }

    public function user_notification()
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        Profile::factory()->forUser($user)->create();

        $admins = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        Notification::send($admins, new NewUserNotification('new user created: ' . $user->email));
    }
}