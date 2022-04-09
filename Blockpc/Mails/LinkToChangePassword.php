<?php

declare(strict_types=1);

namespace Blockpc\Mails;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class LinkToChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_link_to_change_password')
                    ->subject('Link para cambio de contraseña | No Responder')
                    ->from(env('MAIL_FROM_ADDRESS', 'soporte@blockpc.cl'))
                    ->to($this->user->email)
                    ->with('url' , url(route('password.reset', ['token' => $this->token])));
    }
}