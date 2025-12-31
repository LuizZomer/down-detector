<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Auth\Infrastructure\Services\SanctumAuthenticatorService;
use Modules\Auth\Infrastructure\Services\SessionAuthenticator;
use Modules\Users\Infrastructure\Persistence\Eloquent\UserModelRepository;
use Route;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadApiRoutes();
        $this->loadWebRoutes();

        $this->loadViewsFrom(__DIR__ . '/../Ui/Pages', 'Auth');
    }

    public function register()
    {
        $this->app->bind(AuthenticatorService::class, function ($app) {
            $userRepo = $app->make(UserModelRepository::class);

            if (request()->is('api/*')) {
                return new SanctumAuthenticatorService($userRepo);
            }
            return new SessionAuthenticator($userRepo);
        });
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
