<?php

declare(strict_types=1);

namespace Blockpc\App\Providers;

use Blockpc\App\Middlewares\LogUserActivity;
use Blockpc\App\Mixins\Search;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Router;
use Illuminate\Validation\Rules\Password;
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
        $this->app->register(BlockpcEventServiceProvider::class);
        $this->app->register(BlockpcAuthServiceProvider::class);

        Builder::mixin( new Search);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        Password::defaults(function () {
            $rule = Password::min(8);
            return $this->app->isProduction()
                        ? $rule->mixedCase()->uncompromised()
                        : $rule;
        });

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('online', LogUserActivity::class);
    }
}