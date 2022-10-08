<?php

namespace Zaoob\Laravel\Team;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Zaoob\Laravel\Team\Http\Middleware\ZaoobTeamMiddleware;

class TeamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('zaoobTeam', ZaoobTeamMiddleware::class);
    }
}
