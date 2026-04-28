<x-filament-panels::page>
    <div class="space-y-6">
        @if (empty($this->records))
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-yellow-800">
                <p>{{ __('No records found. The LemonSqueezy API may be unavailable or no data exists yet.') }}</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            @php
                                $sample = $this->records[0] ?? [];
                                $attributes = $sample['attributes'] ?? [];
                            @endphp
                            <th class="border border-gray-300 px-4 py-2 text-left">{{ __('ID') }}</th>
                            @foreach (array_keys($attributes) as $key)
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->records as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $record['id'] }}</td>
                                @foreach ($record['attributes'] ?? [] as $value)
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if (is_array($value))
                                            <code class="rounded bg-gray-100 p-1 text-xs">{{ json_encode($value) }}</code>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-filament-panels::page>
