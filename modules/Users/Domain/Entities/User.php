<?php

namespace Modules\Users\Domain\Entities;

class User
{
    public function __construct(
        private string $name,
        private string $email,
        private ?string $password = null,
        private ?int $id = null
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }
    public function email(): string
    {
        return $this->email;
    }
    public function password(): ?string
    {
        return $this->password;
    }
    public function id(): ?int
    {
        return $this->id;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }
    public function changeEmail(string $email): void
    {
        $this->email = $email;
    }
    public function changePassword(string $password): void
    {
        $this->password = $password;
    }
}
