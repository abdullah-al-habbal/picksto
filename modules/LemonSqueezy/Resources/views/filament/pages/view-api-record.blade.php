<x-filament-panels::page>
    <div class="space-y-6">
        @if (empty($this->record))
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                <p>{{ __('Record not found or failed to load from API.') }}</p>
            </div>
        @else
            <div class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="rounded-lg border border-gray-200 bg-white p-4">
                        <p class="text-sm font-semibold text-gray-600">{{ __('ID') }}</p>
                        <p class="mt-1 text-lg font-medium">{{ $this->record['id'] }}</p>
                    </div>

                    @foreach ($this->record['attributes'] ?? [] as $key => $value)
                        <div class="rounded-lg border border-gray-200 bg-white p-4">
                            <p class="text-sm font-semibold text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                            <p class="mt-1 text-sm">
                                @if (is_array($value))
                                    <code class="block rounded bg-gray-100 p-2 text-xs">{{ json_encode($value, JSON_PRETTY_PRINT) }}</code>
                                @elseif (is_bool($value))
                                    <span class="inline-block rounded px-2 py-1 text-xs font-semibold {{ $value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $value ? __('Yes') : __('No') }}
                                    </span>
                                @else
                                    {{ $value }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>

                @if (!empty($this->subscriptions))
                    <div class="mt-8">
                        <h3 class="mb-4 text-lg font-semibold">{{ __('Subscriptions') }}</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('ID') }}</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Status') }}</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Created') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->subscriptions as $sub)
                                        <tr class="hover:bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2">{{ $sub['id'] }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <span class="inline-block rounded px-2 py-1 text-xs font-semibold {{ $sub['attributes']['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $sub['attributes']['status'] ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $sub['attributes']['created_at'] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-filament-panels::page>
