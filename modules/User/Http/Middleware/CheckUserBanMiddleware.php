<?php

declare(strict_types=1);

namespace Modules\User\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class CheckUserBanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->is_banned) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $panel = Filament::getCurrentPanel();
            $loginUrl = $panel?->getLoginUrl() ?? url('/');

            return redirect()->to($loginUrl)
                ->with('error', __('user::user.messages.account_banned'));
        }

        return $next($request);
    }
}
