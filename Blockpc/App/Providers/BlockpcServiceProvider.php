<?php

declare(strict_types=1);

namespace Blockpc\App\Providers;

use Blockpc\App\Commands\CreatePackageCommand;
use Blockpc\App\Http\Livewire\Notification\Pusher;
use Blockpc\App\Http\Livewire\Toast;
use Blockpc\App\Middlewares\DevelopmentAccess;
use Blockpc\App\Middlewares\LogUserActivity;
use Blockpc\App\Mixins\Search;
use Blockpc\Services\Sender;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Router;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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

        $this->app->bind('sender', function() {
            return new Sender;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $blockpc_dir = base_path('Blockpc/'); //__DIR__ .'../../../'

        Model::preventLazyLoading(! app()->isProduction());

        Carbon::setLocale(config('app.locale'));

        Password::defaults(function () {
            $rule = Password::min(8);
            return $this->app->isProduction()
                        ? $rule->mixedCase()->uncompromised()
                        : $rule;
        });

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('online', LogUserActivity::class);
        $router->aliasMiddleware('dev', DevelopmentAccess::class);

        // Load Service Providers...
        $this->loadServiceProviders();

        // Load Livewire Components
        $this->loadWireComponents();

        // Load routes
        $this->loadRoutesFrom($blockpc_dir . 'routes/web.php');

        // load languages files
        $this->loadTranslationsFrom($blockpc_dir.'lang', 'blockpc');

        // Load Views
        $this->loadViewsFrom($blockpc_dir . 'resources/views', 'blockpc');

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
        $this->menus = [];

        foreach ($files->directories(base_path('Packages')) as $directory) {

            $directoryName = last(explode(DIRECTORY_SEPARATOR, $directory));
            $customServiceProvider = "Packages\\{$directoryName}\\App\\Providers\\{$directoryName}ServiceProvider";
            $pathServiceProvider = base_path("Packages/{$directoryName}/App/Providers/{$directoryName}ServiceProvider.php");

            if ( $files->exists($pathServiceProvider) ) {
                $app = $this->app->register($customServiceProvider);
                $this->menus = array_merge($app->config, $this->menus);
            }
        }
    }

    protected function loadWireComponents()
    {
        Livewire::component('blockpc::push-notifications', Pusher::class);
        Livewire::component('blockpc::toast', Toast::class);
    }
}
