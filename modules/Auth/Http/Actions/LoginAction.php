<?php

// modules/Auth/Http/Actions/LoginAction.php

declare(strict_types=1);

namespace Modules\Auth\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Repositories\AuthRepository;
use Modules\User\Models\UserModel;

final class LoginAction
{
    public function __construct(
        private readonly AuthRepository $authRepository,
    ) {}

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $user = $this->authRepository->findByEmail($request->email);

        if (! $user || ! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => __('auth::validation.credentials'),
            ]);
        }

        /** @var UserModel $user */
        if ($user->isBanned()) {
            throw ValidationException::withMessages([
                'email' => __('auth::validation.banned'),
            ]);
        }

        $request->session()->regenerate();

        $user->updateLastLogin();

        return redirect()->route('web.dashboard')
            ->with('success', __('auth::messages.logged_in'));
    }
}
