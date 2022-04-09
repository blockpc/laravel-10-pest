<?php

declare(strict_types=1);

namespace Blockpc\Events;

use App\Models\Company;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class SendMessageClientEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Company $company;
    public $message;

    public function __construct(Company $company, $message)
    {
        $this->company = $company;
        $this->message = $message;
    }
}