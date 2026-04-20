<?php
// modules/User/Http/Middleware/CheckUserBanMiddleware.php

declare(strict_types=1);

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CheckUserBanMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();

        if ($user && $user->is_banned) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('web.auth.login')
                ->with('error', __('user::messages.account_banned'));
        }

        return $next($request);
    }
}
