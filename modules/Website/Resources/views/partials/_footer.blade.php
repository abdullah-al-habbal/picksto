@php
    $siteConfig = \Modules\Settings\Models\SettingModel::get('site_config', []);
    $siteName = $siteConfig['site_name'] ?? config('app.name');
    $contactEmail = \Modules\Settings\Models\SettingModel::get('contact_email', '');
    $contactPhone = \Modules\Settings\Models\SettingModel::get('contact_phone', '');
    $contactAddress = \Modules\Settings\Models\SettingModel::get('contact_address', '');
    $socialLinks = \Modules\Settings\Models\SettingModel::get('social_links', []);
@endphp

<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">{{ $siteName }}</h3>
                <p class="text-sm leading-relaxed">
                    {{ $siteConfig['site_description'] ?? __('website::website.hero.subtitle') }}
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">{{ __('website::website.footer.contact_us') }}</h3>
                <ul class="space-y-3 text-sm">
                    @if ($contactEmail)
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                            <svg class="w-5 h-5 text-teal-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $contactEmail }}</span>
                        </li>
                    @endif
                    @if ($contactPhone)
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                            <svg class="w-5 h-5 text-teal-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span dir="ltr">{{ $contactPhone }}</span>
                        </li>
                    @endif
                    @if ($contactAddress)
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
                            <svg class="w-5 h-5 text-teal-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $contactAddress }}</span>
                        </li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">{{ __('website::website.footer.follow_us') }}</h3>
                <div class="flex space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    @if (!empty($socialLinks))
                        @foreach ($socialLinks as $platform => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-teal-600 hover:text-white transition-colors">
                                <span class="text-xs font-medium uppercase">{{ substr($platform, 0, 2) }}</span>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">{{ __('website::website.nav.pages') }}</h3>
                <ul class="space-y-2 text-sm">
                    @php
                        $footerPages = \Modules\Website\Models\WebsitePageModel::query()->active()->get();
                    @endphp
                    @foreach ($footerPages as $fp)
                        <li>
                            <a href="{{ route('page.show', $fp) }}" class="hover:text-teal-400 transition-colors">{{ $fp->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ $siteName }}. {{ __('website::website.footer.rights') }}
        </div>
    </div>
</footer>
