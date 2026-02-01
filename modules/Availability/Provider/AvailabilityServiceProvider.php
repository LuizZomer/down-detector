<?php

namespace Modules\Availability\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Repository\MonitorRepository;
use Route;

class AvailabilityServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadApiRoutes();
        $this->loadWebRoutes();
    }

    public function register()
    {
        $this->app->bind(
            abstract: MonitorRepositoryInterface::class,
            concrete: MonitorRepository::class
        );
    }

    private function loadApiRoutes()
    {
        $api = __DIR__ . '/../Http/Routes/api.php';

        if (file_exists($api)) {
            Route::prefix('api')->group(function () use ($api) {
                $this->loadRoutesFrom($api);
            });
        }
    }

    private function loadWebRoutes()
    {
        $web = __DIR__ . '/../Http/Routes/web.php';

        if (file_exists($web)) {
            $this->loadRoutesFrom($web);
        }
    }
}
