@extends('website::layouts.public')

@section('title', $page->title)
@section('meta_description', $page->meta_description ?? $page->title)

@section('content')

<section class="bg-white py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (!request()->routeIs('about') && !request()->routeIs('services'))
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-teal-600 mb-8 transition-colors">
                <svg class="w-4 h-4 mr-1 {{ app()->getLocale() === 'ar' ? 'transform rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{ __('website::website.page.back_home') }}
            </a>
        @endif

        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">{{ $page->title }}</h1>

        @if ($page->content)
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($page->content)) !!}
            </div>
        @endif

    </div>
</section>
@endsection
