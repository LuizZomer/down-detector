<?php

namespace App\Shared\Domain\Services;

interface PasswordHasher
{
    public function hash(string $password): string;
    public function verify(string $password, string $hashed): bool;
}
