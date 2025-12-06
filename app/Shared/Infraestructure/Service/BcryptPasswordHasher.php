<?php

namespace App\Shared\Infraestructure\Service;

use App\Shared\Domain\Services\PasswordHasher;
use Hash;

class BcryptPasswordHasher implements PasswordHasher {
    public function hash(string $password): string{
        return Hash::make($password);
    }

    public function verify(string $password, string $hashed): bool
    {
        return Hash::check($password, $hashed);
    }
}