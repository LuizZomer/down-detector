<?php

namespace Modules\Users\Http\Resources;

use JsonSerializable;
use Modules\Users\Domain\Entities\User;

class UserResource implements JsonSerializable
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->user->id(),
            'name' => $this->user->name(),
            'email' => $this->user->email(),
        ];
    }
}
