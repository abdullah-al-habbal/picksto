<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $siteConfig = \Modules\Settings\Models\SettingModel::get('site_config', []);
    $siteName = $siteConfig['site_name'] ?? config('app.name');
    $favicon = $siteConfig['favicon'] ?? null;
    $metaDescription = $siteConfig['site_description'] ?? __('website::website.hero.subtitle');
@endphp

<title>@yield('title', $siteName) — {{ $siteName }}</title>
<meta name="description" content="@yield('meta_description', $metaDescription)">

@if ($favicon)
    <link rel="icon" href="{{ $favicon }}" type="image/x-icon">
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    body { font-family: 'Inter', sans-serif; }
    .fade-in { transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
</style>
