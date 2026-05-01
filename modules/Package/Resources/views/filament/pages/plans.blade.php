<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($packages as $package)
            <div
                class="flex flex-col p-6 space-y-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm transition-all hover:shadow-md">
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $package->getTranslation('name', app()->getLocale()) }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $package->getTranslation('description', app()->getLocale()) }}
                    </p>
                </div>

                <div class="flex items-baseline gap-1">
                    <span class="text-4xl font-extrabold text-primary-600">
                        {{ number_format($package->price, 2) }}
                    </span>
                    <span class="text-sm font-medium text-gray-500">
                        {{ $package->currency }} / {{ $package->duration_days }} {{ __('package::package.labels.days') }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <x-heroicon-m-check-circle class="w-5 h-5 text-success-500" />
                        <span>{{ __('package::package.fields.daily_limit') }}: {{ $package->daily_limit }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <x-heroicon-m-check-circle class="w-5 h-5 text-success-500" />
                        <span>{{ __('package::package.fields.monthly_limit') }}: {{ $package->monthly_limit }}</span>
                    </div>
                    <div class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <x-heroicon-m-check-circle class="w-5 h-5 mt-0.5 text-success-500 shrink-0" />
                        <div>
                            <span class="block font-medium">{{ __('package::package.fields.allowed_sites') }}:</span>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @foreach ($package->allowed_sites as $site)
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                                        {{ __('package::package.sites.' . $site) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-auto">
                    <x-filament::button
                        wire:click="selectPackage({{ $package->id }})"
                        color="primary"
                        class="w-full"
                        size="lg"
                        icon="heroicon-m-sparkles"
                    >
                        {{ __('package::package.labels.singular') }}
                    </x-filament::button>
                </div>
            </div>
        @endforeach
    </div>

    <x-filament::modal id="request-subscription-modal" width="xl">
        <x-slot name="heading">
            {{ __('payment::payment.labels.request_subscription') }}
        </x-slot>

        <form wire:submit.prevent="requestUpgrade">
            <div class="space-y-6">
                <x-filament-schemas::schema :schema="$this->form" />

                <div class="flex justify-end gap-3">
                    <x-filament::button
                        color="gray"
                        x-on:click="close"
                    >
                        {{ __('dashboard.actions.cancel') }}
                    </x-filament::button>

                    <x-filament::button
                        type="submit"
                        color="primary"
                    >
                        {{ __('dashboard.actions.submit') }}
                    </x-filament::button>
                </div>
            </div>
        </form>
    </x-filament::modal>
</x-filament-panels::page>