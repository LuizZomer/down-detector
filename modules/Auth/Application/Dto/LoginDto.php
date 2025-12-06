<?php

namespace Modules\Auth\Application\Dto;

class LoginDto {
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}