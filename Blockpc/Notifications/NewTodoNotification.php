<?php

declare(strict_types=1);

namespace Blockpc\Notifications;

use Blockpc\App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

final class NewTodoNotification extends Notification
{
    use Queueable;
    private Todo $todo;
    private $message;

    public function __construct(Todo $todo, $message)
    {
        $this->todo = $todo;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'user' => $this->todo->user->name,
        ];
    }
}