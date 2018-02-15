<?php

namespace Iankov\ControlPanel;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
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
            __DIR__.'/../public' => public_path(),
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

        $defaultRoute = config('icp.route');
        foreach(config('icp.modules') as $module)
        {
            if(array_get($module, 'active', config('icp.default-module-activity')))
            {
                $route = array_get($module, 'route');
                if (!is_array($route) || !isset($route['path'])) {
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
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $config = require __DIR__ . '/config/icp.php';
        $icp = $this->app['config']->get('icp', []);
        $mergedConfig = array_replace_recursive($config, $icp);

        //do not merge menu, use menu from main config file
        $menu = array_get($icp, 'menu', []);
        $mergedConfig['menu'] = $menu;
        $this->app['config']->set('icp', $mergedConfig);
        //$this->mergeConfigFrom(__DIR__ . '/config/icp.php', 'icp');

        include __DIR__.'/helpers.php';
    }
}
