<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        // Jika middleware hanya untuk routing
        $router->aliasMiddleware('admin', AdminMiddleware::class);
        $router->aliasMiddleware('user', UserMiddleware::class);
    }
}
