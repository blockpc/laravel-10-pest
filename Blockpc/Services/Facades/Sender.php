<?php

declare(strict_types=1);

namespace Blockpc\Services\Facades;

use Illuminate\Support\Facades\Facade;

final class Sender extends Facade
{
    protected static function getFacadeAccessor() { return 'sender'; }
}