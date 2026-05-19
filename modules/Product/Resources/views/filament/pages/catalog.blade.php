<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($products as $product)
            <div class="flex flex-col space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                @if ($product->image_url)
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->getTranslation('name', app()->getLocale()) }}"
                        class="h-40 w-full rounded-xl object-cover"
                    />
                @endif

                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $product->getTranslation('name', app()->getLocale()) }}
                    </h3>
                    @if ($product->getTranslation('description', app()->getLocale()))
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $product->getTranslation('description', app()->getLocale()) }}
                        </p>
                    @endif
                </div>

                <div class="mt-auto flex items-baseline gap-1">
                    <span class="text-2xl font-extrabold text-primary-600">
                        {{ number_format((float) $product->price, 2) }}
                    </span>
                    <span class="text-sm font-medium text-gray-500">
                        {{ $product->currency }}
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <x-filament::section>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ __('product::product.messages.catalog_empty') }}
                    </p>
                </x-filament::section>
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
