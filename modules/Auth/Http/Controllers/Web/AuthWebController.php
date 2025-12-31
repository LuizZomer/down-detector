<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Modules\Auth\Application\UseCases\LoginUseCase;
use Modules\Auth\Domain\Services\AuthenticatorService;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthWebController extends Controller
{
    public function __construct(
        private LoginUseCase $loginUseCase,
    ) {
    }

    public function index()
    {
        return Inertia::render("Auth::login");
    }

    public function login(LoginRequest $request, AuthenticatorService $authenticator)
    {
        $dto = $request->toDto();

        $this->loginUseCase->execute($dto, $authenticator);

        return redirect()->route('auth');
    }
}
