<?php

namespace Modules\Auth\Domain\Services;

use Modules\Users\Domain\Entities\User;

interface AuthenticatorService
{
    public function authenticate(User $user): ?string;
}
