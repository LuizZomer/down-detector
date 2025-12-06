<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Modules\Auth\Application\UseCases\LoginUseCase;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    private LoginUseCase $loginUseCase;

    public function __construct(LoginUseCase $loginUseCase)
    {
        $this->loginUseCase = $loginUseCase;
    }

    public function login(LoginRequest $request)
    {
        $dto = $request->toDto();

        $token = $this->loginUseCase->execute($dto);

        return response()->json(['content' => ['token' => $token]]);
    }

    public function me() {
        return response()->json(['content'=> ['user' => Auth::user()]]);
    }
}
