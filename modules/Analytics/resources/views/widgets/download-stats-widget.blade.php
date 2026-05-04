<!-- picksto-laravel-service\modules\Analytics\resources\views\widgets\download-stats-widget.blade.php -->
<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('analytics::analytics.widgets.download_stats.heading') }}
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/10">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    {{ __('analytics::analytics.widgets.download_stats.today') }}
                </p>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="text-2xl font-bold">{{ $stats['today']['completed'] ?? 0 }}</span>
                    <span class="text-sm text-gray-400">/ {{ $stats['today']['total'] ?? 0 }}</span>
                </div>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/10">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    {{ __('analytics::analytics.widgets.download_stats.month') }}
                </p>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="text-2xl font-bold">{{ $stats['month']['completed'] ?? 0 }}</span>
                    <span class="text-sm text-gray-400">/ {{ $stats['month']['total'] ?? 0 }}</span>
                </div>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/10">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    {{ __('analytics::analytics.widgets.download_stats.total') }}
                </p>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="text-2xl font-bold">{{ $stats['total']['completed'] ?? 0 }}</span>
                    <span class="text-sm text-gray-400">/ {{ $stats['total']['total'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white/5 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                            {{ __('analytics::analytics.widgets.download_stats.by_provider') }}
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            {{ __('analytics::analytics.widgets.download_stats.total') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['byProvider'] as $provider => $count)
                        <tr class="bg-white dark:bg-transparent border-b dark:border-white/5">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $provider }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $count }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>