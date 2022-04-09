<?php

declare(strict_types=1);

namespace Blockpc\Listeners;

use Blockpc\Events\SendMessageClientEvent;
use Blockpc\Mails\SendMessageClientMail;
use Illuminate\Support\Facades\Mail;

final class SendMessageClientListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMessageClientEvent  $event
     * @return void
     */
    public function handle(SendMessageClientEvent $event)
    {
        Mail::to($event->company->email)
            ->send(new SendMessageClientMail($event->company, $event->message));
    }
}