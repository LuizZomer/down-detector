<?php

namespace Modules\Auth\Application\UseCases;

use App\Exceptions\InvalidCredentialException;
use App\Shared\Domain\Services\PasswordHasher;
use Log;
use Modules\Auth\Application\Dto\LoginDto;
use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Users\Application\UseCases\FindUserByUseCase;
use Modules\Users\Domain\Entities\User;

class LoginUseCase
{
    public FindUserByUseCase $findUserByUseCase;
    private PasswordHasher $passwordHasher;

    public function __construct(FindUserByUseCase $findUserByUseCase, PasswordHasher $passwordHasher)
    {
        $this->findUserByUseCase = $findUserByUseCase;
        $this->passwordHasher = $passwordHasher;
    }

    public function execute(LoginDto $loginDto, AuthenticatorService $authenticator)
    {
        $user = $this->findUserByUseCase->execute('email', $loginDto->email);

        $this->validateUser($user, $loginDto->password);

        return $authenticator->authenticate($user);
    }

    public function validateUser(?User $user, $password)
    {
        if (!$user)
            return $this->throwInvalidCredentials();

        $correctPassword = $this->passwordHasher->verify($password, $user->password());

        if (!$correctPassword)
            return $this->throwInvalidCredentials();
    }

    public function throwInvalidCredentials()
    {
        throw new InvalidCredentialException();
    }
}
