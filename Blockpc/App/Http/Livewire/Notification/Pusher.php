<?php

declare(strict_types=1);

namespace Blockpc\App\Http\Livewire\Notification;

use Livewire\Component;

final class Pusher extends Component
{
    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function getUnreadNotificationsProperty()
    {
        return current_user()->unreadNotifications;
    }

    public function render()
    {
        return view('blockpc::livewire.notification.pusher');
    }

    public function mark_as_read(string $uuid)
    {
        current_user()
            ->unreadNotifications
            ->where('id', $uuid)
            ->markAsRead();

        $this->emitSelf('refresh');
    }
}