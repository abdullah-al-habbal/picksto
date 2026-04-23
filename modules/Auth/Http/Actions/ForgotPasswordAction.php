<?php

// modules/Auth/Http/Actions/ForgotPasswordAction.php

declare(strict_types=1);

namespace Modules\Auth\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Modules\Auth\Http\Requests\ForgotPasswordRequest;

final class ForgotPasswordAction
{
    public function __invoke(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->back()->with('success', __($status))
            : redirect()->back()->withInput()->with('error', __($status));
    }
}
