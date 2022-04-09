<?php

declare(strict_types=1);

namespace Blockpc\Mails;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class NewUserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $token;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->company = config('app.name');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_user_created')
                    ->subject('Nuevo Usuario Registrado | No Responder')
                    ->from(env('MAIL_FROM_ADDRESS', 'soporte@blockpc.cl'))
                    ->to($this->user->email)
                    ->with('company' , $this->company )
                    ->with('role' , $this->user->roles->pluck('display_name')->implode(', '))
                    ->with('url' , url(route('password.reset', ['token' => $this->token])));
    }
}