@php
    $siteConfig = \Modules\Settings\Models\SettingModel::get('site_config', []);
    $siteName = $siteConfig['site_name'] ?? config('app.name');
    $logo = $siteConfig['logo'] ?? null;
    $pages = \Modules\Website\Models\WebsitePageModel::query()
        ->active()
        ->whereNotIn('slug', ['about', 'services', 'support'])
        ->get();
@endphp

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <a href="{{ route('home') }}" class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                @if ($logo)
                    <img src="{{ $logo }}" alt="{{ $siteName }}" class="h-8 w-auto">
                @else
                    <span class="text-xl font-bold text-gray-900">{{ $siteName }}</span>
                @endif
            </a>

            <nav class="hidden lg:flex items-center space-x-8 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors {{ request()->routeIs('home') ? 'text-teal-600' : '' }}">
                    {{ __('website::website.nav.home') }}
                </a>
                <a href="{{ route('packages.index') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors {{ request()->routeIs('packages.*') ? 'text-teal-600' : '' }}">
                    {{ __('website::website.nav.packages') }}
                </a>
                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors {{ request()->routeIs('about') ? 'text-teal-600' : '' }}">
                    {{ __('website::website.nav.about') }}
                </a>
                <a href="{{ route('services') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors {{ request()->routeIs('services') ? 'text-teal-600' : '' }}">
                    {{ __('website::website.nav.services') }}
                </a>
                <a href="{{ route('support.show') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors {{ request()->routeIs('support.*') ? 'text-teal-600' : '' }}">
                    {{ __('website::website.nav.support') }}
                </a>

                @if ($pages->isNotEmpty())
                    <div class="relative group">
                        <button class="text-sm font-medium text-gray-700 hover:text-teal-600 transition-colors flex items-center">
                            {{ __('website::website.nav.pages') }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-1">
                                @foreach ($pages as $p)
                                    <a href="{{ route('page.show', $p) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-teal-600">
                                        {{ $p->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </nav>

            <div class="flex items-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                @auth
                    <a href="{{ url('/client') }}" class="hidden lg:inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition-colors">
                        {{ __('website::website.nav.dashboard') }}
                    </a>
                @else
                    <a href="{{ url('/client/login') }}" class="hidden lg:inline-flex items-center px-4 py-2 text-sm font-medium text-teal-600 border border-teal-600 rounded-lg hover:bg-teal-50 transition-colors">
                        {{ __('website::website.nav.login') }}
                    </a>
                @endauth

                <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-700 hover:text-teal-600" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-gray-100 pt-4">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600">{{ __('website::website.nav.home') }}</a>
                <a href="{{ route('packages.index') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600">{{ __('website::website.nav.packages') }}</a>
                <a href="{{ route('about') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600">{{ __('website::website.nav.about') }}</a>
                <a href="{{ route('services') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600">{{ __('website::website.nav.services') }}</a>
                <a href="{{ route('support.show') }}" class="text-sm font-medium text-gray-700 hover:text-teal-600">{{ __('website::website.nav.support') }}</a>
                @foreach ($pages as $p)
                    <a href="{{ route('page.show', $p) }}" class="text-sm font-medium text-gray-600 hover:text-teal-600">{{ $p->title }}</a>
                @endforeach
                <hr class="my-2">
                @auth
                    <a href="{{ url('/client') }}" class="text-sm font-medium text-teal-600">{{ __('website::website.nav.dashboard') }}</a>
                @else
                    <a href="{{ url('/client/login') }}" class="text-sm font-medium text-teal-600">{{ __('website::website.nav.login') }}</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
