<?php

namespace Modules\Users\Application\UseCases;

use App\Exceptions\EmailAlreadyExistsException;
use App\Shared\Domain\Services\PasswordHasher;
use Modules\Users\Application\Dto\CreateUserDto;
use Modules\Users\Domain\Entities\User;
use Modules\Users\Domain\Repositories\UserRepositoryInterface;

class CreateUserUseCase {
    private UserRepositoryInterface $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, PasswordHasher $passwordHasher) {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function execute(CreateUserDto $dto): User {
        $this->validateEmail($dto->email);

        $hashedPassword = $this->passwordHasher->hash($dto->password);

        $user = new User($dto->name, $dto->email, $hashedPassword, null);

        return $this->userRepository->create($user);
    }

    private function validateEmail(string $email) {
        $hasRegister = $this->userRepository->findBy('email', $email);

        if($hasRegister) {
            throw new EmailAlreadyExistsException();
        }
    }
}