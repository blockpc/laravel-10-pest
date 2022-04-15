<?php

declare(strict_types=1);

namespace Blockpc\App\Middlewares;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

final class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        if ( Auth::check() ) {
            $expireAt = Carbon::now()->addMinutes(5);
            Cache::put('user-online-'.current_user()->id, true, $expireAt);
        }
        return $next($request);
    }
}