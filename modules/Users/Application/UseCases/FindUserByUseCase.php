<?php

namespace Modules\Users\Application\UseCases;

use Modules\Users\Domain\Entities\User;
use Modules\Users\Domain\Repositories\UserRepositoryInterface;

class FindUserByUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $column, mixed $value): ?User
    {
        return $this->userRepository->findBy($column, $value);
    }
}
