<?php

namespace Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Log;
use Modules\Users\Application\UseCases\CreateUserUseCase;
use Modules\Users\Http\Requests\CreateUserRequest;
use Modules\Users\Http\Resources\UserResource;

class UserController extends Controller {
    public CreateUserUseCase $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase) {
        $this->createUserUseCase = $createUserUseCase;
    }

    public function index(CreateUserRequest $request) {
        $dto = $request->toDto();

        $newUser = $this->createUserUseCase->execute($dto);

        return response()->json(['content' => ['user' => new UserResource($newUser)]]);
    }
}