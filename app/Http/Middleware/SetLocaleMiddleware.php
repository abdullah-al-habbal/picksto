<?php

// filePath: app\Http\Middleware\SetLocaleMiddleware.php

namespace App\Http\Middleware;

use Modules\Language\Models\LanguageModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->determineLocale($request);

        $this->applyLocale($locale);

        return $next($request);
    }

    private function determineLocale(Request $request): string
    {
        if ($locale = $this->getUserPreferredLocale($request)) {
            return $locale;
        }

        if ($locale = $this->getHeaderPreferredLocale($request)) {
            return $locale;
        }

        if ($locale = $this->getDefaultLocale()) {
            return $locale;
        }

        return $this->getFallbackLocale();
    }

    private function getUserPreferredLocale(Request $request): ?string
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return null;
        }

        $user->load('setting.language');
        $languageCode = $user->setting?->language?->code;

        return $this->isActiveLocale($languageCode) ? $languageCode : null;
    }

    private function getHeaderPreferredLocale(Request $request): ?string
    {
        $available = $this->getActiveLocales();

        $headerLocale = $request->getPreferredLanguage($available);

        return $this->isActiveLocale($headerLocale) ? $headerLocale : null;
    }

    private function getDefaultLocale(): ?string
    {
        $default = LanguageModel::getDefault();

        return $default?->code;
    }

    private function getFallbackLocale(): string
    {
        return config('app.locale', 'en');
    }

    private function getActiveLocales(): array
    {
        return LanguageModel::where('is_active', true)->pluck('code')->toArray();
    }

    private function applyLocale(string $locale): void
    {
        App::setLocale($locale);
    }

    private function isActiveLocale(?string $code): bool
    {
        if (!$code) {
            return false;
        }

        return LanguageModel::where('code', $code)
            ->where('is_active', true)
            ->exists();
    }
}
