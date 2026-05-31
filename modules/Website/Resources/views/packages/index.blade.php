@extends('website::layouts.public')

@section('title', __('website::website.nav.packages'))
@section('meta_description', __('website::website.packages.subtitle'))

@section('content')

<section class="bg-gray-50 min-h-screen py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ __('website::website.packages.title') }}</h1>
            <p class="mt-3 text-lg text-gray-600">{{ __('website::website.packages.subtitle') }}</p>
        </div>

        <form method="GET" class="flex flex-wrap gap-4 items-end justify-center mb-10">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.packages.sort_by') }}</label>
                <select name="sort" onchange="this.form.submit()" class="rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    <option value="">{{ __('website::website.packages.sort_default') }}</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>{{ __('website::website.packages.sort_price_low') }}</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>{{ __('website::website.packages.sort_price_high') }}</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.packages.filter_site') }}</label>
                <select name="site" onchange="this.form.submit()" class="rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm">
                    <option value="">{{ __('website::website.packages.all_sites') }}</option>
                    @foreach ($allSites as $site)
                        <option value="{{ $site }}" {{ request('site') === $site ? 'selected' : '' }}>{{ $site }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        @if ($packages->isEmpty())
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">{{ __('website::website.packages.no_results') }}</p>
            </div>
        @else
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

                            @if ($package->allowed_sites)
                                <div class="mt-4">
                                    <span class="text-xs font-medium text-gray-500">{{ __('website::website.packages.allowed_sites') }}:</span>
                                    <div class="flex flex-wrap gap-1.5 mt-1">
                                        @foreach ((array) $package->allowed_sites as $site)
                                            <span class="inline-block px-2 py-0.5 text-xs font-medium bg-teal-50 text-teal-700 rounded-full">{{ $site }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 pt-0">
                            <a href="{{ route('packages.show', $package) }}" class="block w-full text-center px-4 py-2.5 bg-teal-600 text-white hover:bg-teal-700 font-medium rounded-xl transition-all">
                                {{ __('website::website.packages.learn_more') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
