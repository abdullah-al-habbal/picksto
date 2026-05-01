<x-filament-panels::page>
    <form wire:submit.prevent="save" class="space-y-6">
        <x-filament-schemas::schema :schema="$this->form" />

        <div class="flex justify-start">
            <x-filament::button type="submit" size="lg">
                {{ __('dashboard.actions.save_changes') }}
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
