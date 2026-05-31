@extends('website::layouts.public')

@section('title', $package->name)
@section('meta_description', $package->description)

@section('content')

<section class="bg-white py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('packages.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-teal-600 mb-8 transition-colors">
            <svg class="w-4 h-4 mr-1 {{ app()->getLocale() === 'ar' ? 'transform rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('website::website.packages.back') }}
        </a>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-8 lg:p-12">
                <div class="lg:flex lg:items-start lg:justify-between lg:gap-12">
                    <div class="flex-1">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">{{ $package->name }}</h1>

                        @if ($package->description)
                            <div class="mt-4 text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $package->description }}
                            </div>
                        @endif

                        <div class="mt-8 grid sm:grid-cols-3 gap-6">
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <span class="block text-2xl font-bold text-teal-600">{{ $package->daily_limit }}</span>
                                <span class="text-xs text-gray-500">{{ __('website::website.packages.daily_limit') }}</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <span class="block text-2xl font-bold text-teal-600">{{ $package->monthly_limit }}</span>
                                <span class="text-xs text-gray-500">{{ __('website::website.packages.monthly_limit') }}</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <span class="block text-2xl font-bold text-teal-600">{{ $package->duration_days }}</span>
                                <span class="text-xs text-gray-500">{{ __('website::website.packages.duration_days') }} ({{ __('website::website.packages.days') }})</span>
                            </div>
                        </div>

                        @if ($package->allowed_sites)
                            <div class="mt-8">
                                <h3 class="text-sm font-semibold text-gray-900 mb-3">{{ __('website::website.packages.allowed_sites') }}</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ((array) $package->allowed_sites as $site)
                                        <span class="inline-flex px-3 py-1 text-sm font-medium bg-teal-50 text-teal-700 rounded-full border border-teal-200">{{ $site }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 lg:mt-0 lg:w-80 shrink-0">
                        <div class="bg-gray-50 rounded-2xl p-6 text-center sticky top-24">
                            <p class="text-sm text-gray-500 mb-1">{{ __('website::website.packages.price') }}</p>
                            <p class="text-4xl font-extrabold text-gray-900">
                                {{ $package->currency }} {{ number_format($package->price, 2) }}
                            </p>

                            @auth
                                <a href="{{ url('/client/subscriptions') }}" class="mt-6 block w-full px-6 py-3 bg-teal-600 text-white font-semibold rounded-xl hover:bg-teal-700 transition-all shadow-lg">
                                    {{ __('website::website.packages.subscribe') }}
                                </a>
                            @else
                                <a href="{{ url('/client/login') }}" class="mt-6 block w-full px-6 py-3 bg-teal-600 text-white font-semibold rounded-xl hover:bg-teal-700 transition-all shadow-lg">
                                    {{ __('website::website.packages.login_required') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
