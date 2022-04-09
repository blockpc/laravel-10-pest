<?php

declare(strict_types=1);

namespace Blockpc\Mails;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class SendMessageClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public Company $company;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company, $content)
    {
        $this->company = $company;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_message_client', [
            'content' => $this->content,
            'company' => $this->company,
        ])
            ->subject('Nuevo mesaje Administrador | No Responder')
            ->from(env('MAIL_FROM_ADDRESS', 'soporte@blockpc.cl'));
    }
}