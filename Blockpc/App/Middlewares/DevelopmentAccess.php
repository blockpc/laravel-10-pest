<?php

declare(strict_types=1);

namespace Blockpc\App\Middlewares;

use Closure;

final class DevelopmentAccess
{
    /**
     * Client IPs allowed to access the app.
     * Defaults are loopback IPv4 and IPv6 for use in local development.
     * 
     * @var array
     */
    protected $ipWhitelist = ['127.0.0.1', '::1'];

    /**
     * Environment not allowed to access the app.
     * Environment production.
     * 
     * @var string
     */
    protected $production = 'production';

    public function handle($request, Closure $next)
    {
        if ( $this->isProductionEnvironment() && $this->clientNotAllowed() ) {
            return abort(403, 'You are not authorized to access this');
        }

        return $next($request);
    }

    /**
     * Checks if current environment is allowed to access the app.
     *
     * @return boolean
     */
    protected function isProductionEnvironment()
    {
        return app()->environment() != $this->production;
    }

    /**
     * Checks if current request client is allowed to access the app.
     *
     * @return boolean
     */
    protected function clientNotAllowed()
    {
        $isAllowedIP = in_array(request()->ip(), $this->ipWhitelist);

        return !$isAllowedIP;
    }
}