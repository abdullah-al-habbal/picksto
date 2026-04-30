<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        @php $stats = $this->getReferralStats(); @endphp
        <x-filament::section>
            <div class="text-sm font-medium text-gray-500">Total Referrals</div>
            <div class="text-2xl font-bold">{{ $stats['total'] ?? 0 }}</div>
        </x-filament::section>
        <x-filament::section>
            <div class="text-sm font-medium text-gray-500">Active Referrals</div>
            <div class="text-2xl font-bold">{{ $stats['active'] ?? 0 }}</div>
        </x-filament::section>
        <div class="flex items-center justify-end">
            {{ $this->claimRewardsAction }}
        </div>
    </div>

    <x-filament::section>
        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>
