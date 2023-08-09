<?php

declare(strict_types=1);

namespace Packages\Book\App\Providers;

use Illuminate\Support\ServiceProvider;

final class BookServiceProvider extends ServiceProvider
{
    public $config;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $package_dir = $this->getPath();

        $this->app->register(AuthBookServiceProvider::class);

        $this->mergeConfigFrom($package_dir.'config/config.php', 'book');
        $this->config = $this->app->config->get('book.menus');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_dir = $this->getPath();

        // Routes
        $this->loadRoutesFrom($package_dir.'routes/web.php');

        // Views
        $this->loadViewsFrom($package_dir.'resources/views', 'book');

        // Migrations
        $this->loadMigrationsFrom($package_dir.'database/migrations');

        // Translations
        $this->loadTranslationsFrom($package_dir.'lang', 'book');
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        return $path;
    }
}
