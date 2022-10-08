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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'zaoob.team');
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

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('zaoob/team.php'),
            ], ['zaoob', 'team', 'config']);
        }
    }
}
