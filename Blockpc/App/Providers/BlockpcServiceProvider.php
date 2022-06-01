<?php

declare(strict_types=1);

namespace Blockpc\App\Providers;

use Blockpc\App\Commands\CreatePackageCommand;
use Blockpc\App\Middlewares\LogUserActivity;
use Blockpc\App\Mixins\Search;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Router;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;

final class BlockpcServiceProvider extends ServiceProvider
{
    public $menus;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'../../../config/config.php', 'blockpc');

        $this->app->register(BlockpcEventServiceProvider::class);
        $this->app->register(BlockpcAuthServiceProvider::class);

        Builder::mixin(new Search);
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

        $this->loadServiceProviders();

        // Register the command if we are using the application via the CLI
		if ($this->app->runningInConsole()) {
			$this->commands([
				CreatePackageCommand::class
			]);
		}

        $this->app->singleton('menus', function($app) {
            return $this->menus;
        });
    }

    protected function loadServiceProviders()
    {
        /** @var \Illuminate\Filesystem\Filesystem $files */
        $files = $this->app->make('files');
        $this->menus = \Config::get('blockpc.menus');

        foreach ($files->directories(base_path('Packages')) as $directory) {
            
            $directoryName = last(explode('\\', $directory));
            $customServiceProvider = "Packages\\{$directoryName}\\App\\Providers\\{$directoryName}ServiceProvider";
            $pathServiceProvider = base_path("{$customServiceProvider}.php");

            if ( $files->exists($pathServiceProvider) ) {
                $app = $this->app->register($customServiceProvider);
                $this->menus = array_merge($app->config, $this->menus);
            }
        }
    }
}