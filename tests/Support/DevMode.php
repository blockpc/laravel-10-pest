<?php

declare(strict_types=1);

namespace Tests\Support;

trait DevMode 
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

    protected function dev_mode()
    {
        return $this->isProductionEnvironment() && $this->clientNotAllowed();
    }

    /**
     * Checks if current request client is allowed to access the app.
     *
     * @return boolean
     */
    protected function clientNotAllowed()
    {
        return !in_array(request()->ip(), $this->ipWhitelist);
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
}