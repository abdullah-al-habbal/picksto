<?php
// app/Http/Middleware/CheckRole.php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        $user = $request->user();

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, __('auth::messages.unauthorized'));
        }

        return $next($request);
    }
}
