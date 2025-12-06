<?php

namespace Modules\Users\Infrastructure\Mappers;

use Log;
use Modules\Users\Domain\Entities\User;
use Modules\Users\Infrastructure\Persistence\Eloquent\UserModel;

class UserFindByMapper
{
    public static function modelToEntity(UserModel $userModel)
    {
        return new User(
            $userModel->name,
            $userModel->email,
            $userModel->password,
            $userModel->id
        );
    }
}
