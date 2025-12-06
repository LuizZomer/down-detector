<?php

namespace Modules\Users\Infrastructure\Persistence\Eloquent;

use Modules\Users\Infrastructure\Persistence\Eloquent\UserModel;

class UserModelRepository
{
    protected UserModel $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function findBy(string $column, mixed $value): ?UserModel
    {
        $model = $this->model->where($column, $value)->first();

        if (!$model) {
            return null;
        }

        return $model;
    }
}
