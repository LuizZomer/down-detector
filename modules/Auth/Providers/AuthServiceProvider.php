<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Domain\Services\TokenService;
use Modules\Auth\Infrastructure\Services\SanctumTokenService;
use Route;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadApiRoutes();
        $this->loadWebRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Auth');
    }

    public function register()
    {
        $this->app->bind(
            TokenService::class,
            SanctumTokenService::class
        );
    }

    private function loadApiRoutes()
    {
        $api = __DIR__ . '/../Http/Routes/api.php';

        if (file_exists($api)) {
            Route::prefix('api')
                ->middleware('api')
                ->group(function () use ($api) {
                    $this->loadRoutesFrom($api);
                });
        }
    }

    private function loadWebRoutes()
    {
        $web = __DIR__ . '/../Http/Routes/web.php';

        Route::middleware('web')
            ->group(function () use ($web) {
                $this->loadRoutesFrom($web);
            });
    }
}
