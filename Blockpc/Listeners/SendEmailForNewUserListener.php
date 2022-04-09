<?php

declare(strict_types=1);

namespace Blockpc\Listeners;

use Blockpc\Events\SendEmailForNewUserEvent;
use Blockpc\Mails\NewUserCreatedMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

final class SendEmailForNewUserListener
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
     * @param  SendEmailForNewUserEvent  $event
     * @return void
     */
    public function handle(SendEmailForNewUserEvent $event)
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert(
            ['email' => $event->user->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($event->user->email)
            ->send(new NewUserCreatedMail($event->user, $token));
    }
}