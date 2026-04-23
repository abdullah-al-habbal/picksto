<?php

// modules/Auth/Http/Actions/ResetPasswordAction.php

declare(strict_types=1);

namespace Modules\Auth\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Modules\Auth\Http\Requests\ResetPasswordRequest;

final class ResetPasswordAction
{
    public function __invoke(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function ($user, $password): void {
                $user->forceFill([
                    'password' => $password,
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('web.auth.login')->with('success', __($status))
            : redirect()->back()->withInput()->with('error', __($status));
    }
}
