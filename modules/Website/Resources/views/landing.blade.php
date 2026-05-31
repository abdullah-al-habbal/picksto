{{-- picksto/modules/Website/Resources/views/landing.blade.php --}}
@extends('website::layouts.public')

@section('title', $settings['site_name'])

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-gray-800 to-teal-900 text-white">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE4YzEuNjU3IDAgMyAxLjM0MyAzIDNzLTEuMzQzIDMtMyAzLTMtMS4zNDMtMy0zIDEuMzQzLTMgMy0zeiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                {{ $settings['hero_title'] ?: __('website::website.hero.title') }}
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-gray-300 leading-relaxed max-w-2xl">
                {{ $settings['hero_subtitle'] ?: __('website::website.hero.subtitle') }}
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('packages.index') }}" class="inline-flex items-center px-6 py-3 bg-teal-500 hover:bg-teal-400 text-white font-semibold rounded-xl transition-all shadow-lg hover:shadow-teal-500/25">
                    {{ __('website::website.hero.cta') }}
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Features --}}
@php $features = $settings['features'] ?? []; @endphp
@if (!empty($features))
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ __('website::website.features.title') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('website::website.features.subtitle') }}</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($features as $feature)
                <div class="fade-in opacity-0 translate-y-8 p-8 bg-gray-50 rounded-2xl hover:shadow-lg hover:bg-white transition-all duration-300">
                    @if (!empty($feature['icon']))
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-teal-100 text-teal-600 mb-5 text-2xl">{{ $feature['icon'] }}</div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $feature['title'] ?? '' }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $feature['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Packages Preview --}}
@if ($packages->isNotEmpty())
<section class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ __('website::website.packages.title') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('website::website.packages.subtitle') }}</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($packages as $package)
                <div class="fade-in opacity-0 translate-y-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    <div class="p-6 flex-1">
                        <h3 class="text-xl font-bold text-gray-900">{{ $package->name }}</h3>
                        <p class="mt-1 text-3xl font-extrabold text-teal-600">
                            {{ $package->currency }} {{ number_format($package->price, 2) }}
                        </p>
                        @if ($package->description)
                            <p class="mt-3 text-sm text-gray-600 line-clamp-2">{{ $package->description }}</p>
                        @endif
                        <ul class="mt-4 space-y-2 text-sm text-gray-600">
                            <li class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                                <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ __('website::website.packages.daily_limit') }}: {{ $package->daily_limit }}</span>
                            </li>
                            <li class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                                <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ __('website::website.packages.monthly_limit') }}: {{ $package->monthly_limit }}</span>
                            </li>
                            <li class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                                <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ __('website::website.packages.duration_days') }}: {{ $package->duration_days }} {{ __('website::website.packages.days') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('packages.show', $package) }}" class="block w-full text-center px-4 py-2.5 border border-teal-600 text-teal-600 hover:bg-teal-600 hover:text-white font-medium rounded-xl transition-all">
                            {{ __('website::website.packages.learn_more') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-all">
                {{ __('website::website.packages.view_all') }}
            </a>
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20 lg:py-28 bg-gradient-to-br from-teal-600 to-teal-800 text-white">
    <div class="max-w-3xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold">{{ __('website::website.cta.title') }}</h2>
        <p class="mt-4 text-lg text-teal-100">{{ __('website::website.cta.subtitle') }}</p>
        <div class="mt-8">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center px-8 py-3 bg-white text-teal-700 font-semibold rounded-xl hover:bg-teal-50 transition-all shadow-lg">
                {{ __('website::website.cta.button') }}
            </a>
        </div>
    </div>
</section>
@endsection
