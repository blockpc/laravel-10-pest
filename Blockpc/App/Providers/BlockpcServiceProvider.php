<?php

declare(strict_types=1);

namespace Blockpc\App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

final class BlockpcServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->register(BlockpcEventServiceProvider::class);
        // $this->app->register(BlockpcAuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
    }
}