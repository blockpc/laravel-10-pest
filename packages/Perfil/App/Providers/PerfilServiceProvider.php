<?php

declare(strict_types=1);

namespace Packages\Perfil\App\Providers;

use Illuminate\Support\ServiceProvider;

final class PerfilServiceProvider extends ServiceProvider
{
    public $config;
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'../../../config/config.php', 'perfil');
        $this->config = $this->app->config->get('perfil.menus');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'../../../routes/web.php');
        
        // Views
        $this->loadViewsFrom(__DIR__.'../../../resources/views', 'perfil');

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'../../../database/migrations');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'../../../resources/lang', 'perfil');
    }
}