<?php

declare(strict_types=1);

namespace Blockpc\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Blockpc\App\Models\Todo;
use Blockpc\Services\Facades\Sender;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create_notification(Request $request)
    {
        $admin = User::find(2);

        $count = Todo::count() + 1;
        $todo = Todo::create([
            'name' => 'todo test. ' . $count,
            'description' => 'todo description',
            'tasks' => ['task one', 'task two'],
            'user_id' => $admin->id,
        ]);
        $message = "A new todo created. {$count}";

        Sender::new_todo($todo, $message);
    }
}