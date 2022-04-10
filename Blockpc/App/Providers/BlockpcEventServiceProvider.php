<?php

declare(strict_types=1);

namespace Blockpc\App\Providers;

use Blockpc\Events\SendEmailForNewUserEvent;
use Blockpc\Events\ReSendLinkToChangePasswordEvent;
use Blockpc\Events\SendMessageClientEvent;
use Blockpc\Listeners\ReSendEmailForNewUserListener;
use Blockpc\Listeners\SendEmailForNewUserListener;
use Blockpc\Listeners\SendMessageClientListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class BlockpcEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendEmailForNewUserEvent::class => [
            SendEmailForNewUserListener::class,
        ],
        ReSendLinkToChangePasswordEvent::class => [
            ReSendEmailForNewUserListener::class,
        ],
        SendMessageClientEvent::class => [
            SendMessageClientListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}