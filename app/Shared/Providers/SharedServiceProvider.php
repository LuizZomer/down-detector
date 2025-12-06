<?php

namespace App\Shared\Providers;

use App\Shared\Infraestructure\Service\BcryptPasswordHasher;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Gate;
use Illuminate\Support\ServiceProvider;
use App\Shared\Domain\Services\PasswordHasher;

class SharedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });

        Gate::define('viewApiDocs', function ($user = null) {
            return true;
        });
    }
    public function register()
    {
        $this->app->bind(
            PasswordHasher::class,
            BcryptPasswordHasher::class
        );
    }
}
