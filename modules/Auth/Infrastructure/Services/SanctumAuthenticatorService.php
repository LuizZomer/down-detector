<?php

namespace Modules\Auth\Infrastructure\Services;

use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Users\Domain\Entities\User;
use Modules\Users\Infrastructure\Persistence\Eloquent\UserModelRepository;

class SanctumAuthenticatorService implements AuthenticatorService
{
    protected UserModelRepository $modelRepository;

    public function __construct(UserModelRepository $model)
    {
        $this->modelRepository = $model;
    }

    public function authenticate(User $user): string
    {
        $userModel = $this->modelRepository->findBy('id', $user->id());

        return $userModel->createToken('api-token')->plainTextToken;
    }
}
