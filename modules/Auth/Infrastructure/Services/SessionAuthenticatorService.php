<?php

namespace Modules\Auth\Infrastructure\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Users\Domain\Entities\User;
use Modules\Users\Infrastructure\Persistence\Eloquent\UserModelRepository;

class SessionAuthenticator implements AuthenticatorService
{
    public function __construct(protected UserModelRepository $modelRepository)
    {
    }

    public function authenticate(User $user): ?string
    {
        $userModel = $this->modelRepository->findBy('id', $user->id());

        Auth::login($userModel);
        request()->session()->regenerate();
        return null;
    }
}
