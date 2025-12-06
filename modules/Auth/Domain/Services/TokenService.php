<?php

namespace Modules\Auth\Domain\Services;

use Modules\Users\Domain\Entities\User;

interface TokenService
{
    public function createToken(User $user): string;
}
