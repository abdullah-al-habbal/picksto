<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-filament-schemas::schema :schema="$this->form" />
        </x-filament::section>

        {{ $this->table }}
    </div>
</x-filament-panels::page>