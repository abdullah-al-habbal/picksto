<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Client\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Modules\Settings\Repositories\SettingsRepository;
use Modules\Settings\Filament\Client\Schemas\SettingsForm;

final class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Account Settings';
    protected static ?int $navigationSort = 10;
    protected string $view = 'settings::filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $repository = app(SettingsRepository::class);
        $settings = $repository->getSettings(false) ?? [];

        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return SettingsForm::configure($schema)
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $repository = app(SettingsRepository::class);
            // fix:
            $repository->updateUserSettings(auth()->id(), $this->form->getState());

            Notification::make()
                ->success()
                ->title('Settings Updated')
                ->body('Your preferences have been saved.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Failed to update settings.')
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Account';
    }
}
