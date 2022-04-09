<?php

declare(strict_types=1);

namespace Blockpc\Listeners;

use Blockpc\Events\ReSendLinkToChangePasswordEvent;
use Blockpc\Mails\LinkToChangePassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

final class ReSendEmailForNewUserListener
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
     * @param  ReSendLinkToChangePasswordEvent  $event
     * @return void
     */
    public function handle(ReSendLinkToChangePasswordEvent $event)
    {
        $token = Str::random(64);
        
        $event->user->email_verified_at = null;
        $event->user->save();
        
        DB::table('password_resets')->insert(
            ['email' => $event->user->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($event->user->email)
            ->send(new LinkToChangePassword($event->user, $token));
    }
}