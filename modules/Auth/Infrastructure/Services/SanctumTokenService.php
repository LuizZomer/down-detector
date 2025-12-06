<?php

namespace Modules\Auth\Infrastructure\Services;

use Modules\Auth\Domain\Services\TokenService;
use Modules\Users\Domain\Entities\User;
use Modules\Users\Infrastructure\Persistence\Eloquent\UserModelRepository;

class SanctumTokenService implements TokenService
{
    protected UserModelRepository $modelRepository;

    public function __construct(UserModelRepository $model)
    {
        $this->modelRepository = $model;
    }

    public function createToken(User $user): string
    {
        $userModel = $this->modelRepository->findBy('id', $user->id());

        return $userModel->createToken('api-token')->plainTextToken;
    }
}
