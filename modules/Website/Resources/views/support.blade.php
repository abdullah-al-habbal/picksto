@extends('website::layouts.public')

@section('title', __('website::website.support.title'))
@section('meta_description', __('website::website.support.subtitle'))

@section('content')

<section class="bg-gray-50 py-16 lg:py-24">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-xl mx-auto mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ __('website::website.support.title') }}</h1>
            <p class="mt-3 text-lg text-gray-600">{{ __('website::website.support.subtitle') }}</p>
        </div>

        @if (session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('support.submit') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.support.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.support.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.support.subject') }}</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">{{ __('website::website.support.message') }}</label>
                    <textarea id="message" name="message" rows="6" required
                              class="w-full rounded-xl border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-teal-600 text-white font-semibold rounded-xl hover:bg-teal-700 transition-all shadow-lg">
                    {{ __('website::website.support.submit') }}
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
