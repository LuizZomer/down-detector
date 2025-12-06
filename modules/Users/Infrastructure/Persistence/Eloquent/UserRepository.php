<?php

namespace Modules\Users\Infrastructure\Persistence\Eloquent;

use Modules\Users\Domain\Entities\User;
use Modules\Users\Domain\Repositories\UserRepositoryInterface;
use Modules\Users\Infrastructure\Mappers\CreateUserMapper;
use Modules\Users\Infrastructure\Mappers\UserFindByMapper;

class UserRepository implements UserRepositoryInterface
{
    protected UserModel $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function create(User $user): User
    {
        $newUser = $this->model->create([
            'name' => $user->name(),
            'email' => $user->email(),
            'password' => $user->password(),
        ]);

        return CreateUserMapper::modelToEntity($newUser);
    }

    public function findBy(string $column, string $value): ?User
    {
        $model = $this->model->where($column, $value)->first();

        if (!$model) {
            return null;
        }

        return UserFindByMapper::modelToEntity($model);
    }
}
