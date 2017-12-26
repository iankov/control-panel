<?php

namespace Iankov\ControlPanel;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/views', 'icp');

        $this->publishes([
            __DIR__.'/config' => base_path('config'),
        ], 'icp_config');

        $this->publishes([
            __DIR__.'/../public' => public_path('icp'),
        ], 'icp_public');

        /*$this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/iankov/control-panel'),
        ], 'icp_views');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'icp_migrations');

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds')
        ], 'icp_seeds');*/

        $router->middlewareGroup('icp', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            \Iankov\ControlPanel\Middlewares\AdminAuth::class,
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/icp.php', 'icp');

        include __DIR__.'/helpers.php';

        $defaultRoute = config('icp.route');

        foreach(config('icp.modules') as $module){
            $route = array_get($module, 'route');
            if(!is_array($route) || !isset($route['path'])){
                continue;
            }
            $prefix = array_get($route, 'prefix-url', $defaultRoute['prefix-url']);
            $name = array_get($route, 'prefix-name', $defaultRoute['prefix-name']);
            $middleware = array_get($route, 'middleware', $defaultRoute['middleware']);
            $namespace = array_get($route, 'namespace', $defaultRoute['namespace']);

            Route::prefix($prefix)
                ->name($name)
                ->middleware($middleware)
                ->namespace($namespace)
                ->group($route['path']);
        }

        //$this->app->make('Iankov\ControlPanel\Controllers\AdminController');
    }
}
