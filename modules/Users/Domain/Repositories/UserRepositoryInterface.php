<?php

namespace Modules\Users\Domain\Repositories;

use Modules\Users\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findBy(string $column, string $value): ?User;

    public function create(User $user): User;

    // public function all(): array;
}
