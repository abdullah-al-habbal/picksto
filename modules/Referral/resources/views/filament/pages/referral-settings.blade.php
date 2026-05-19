<x-filament-panels::page>
    <x-filament-panels::form wire:submit="submit">
        {{ $this->form }}

        <x-filament::button type="submit" size="sm">
            {{ __('dashboard.actions.save') }}
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
