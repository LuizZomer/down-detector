<?php

namespace Modules\Users\Http\Controllers\Web;

use Inertia\Inertia;
use Modules\Users\Application\UseCases\CreateUserUseCase;
use Modules\Users\Http\Requests\CreateUserRequest;

class UserWebController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase
    ) {
    }

    public function index()
    {
        return Inertia::render('Users::Register');
    }

    public function store(CreateUserRequest $request)
    {
        $dto = $request->toDto();

        $this->createUserUseCase->execute($dto);

        return redirect()->route('login')->withErrors([]);
    }
}
