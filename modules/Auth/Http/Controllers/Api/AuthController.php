<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Modules\Auth\Application\UseCases\LoginUseCase;
use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function __construct(
        private LoginUseCase $loginUseCase,
    ) {
    }

    public function login(LoginRequest $request, AuthenticatorService $authenticator)
    {
        $dto = $request->toDto();

        $token = $this->loginUseCase->execute($dto, $authenticator);

        return response()->json(['content' => ['token' => $token]]);
    }

    public function me()
    {
        return response()->json(['content' => ['user' => Auth::user()]]);
    }
}
