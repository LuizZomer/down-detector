<?php

namespace Modules\Users\Application\Dto;

class CreateUserDto {
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password,
    ) {}
}