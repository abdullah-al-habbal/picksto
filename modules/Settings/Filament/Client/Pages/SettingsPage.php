<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Client\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Settings\Repositories\SettingsRepository;

final class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Account Settings';
    protected static ?int $navigationSort = 10;
    protected string $view = 'filament.pages.settings';

    public function getSettings(): array
    {
        $repository = app(SettingsRepository::class);
        return $repository->getSettings(false) ?? [];
    }

    public function updateNotificationPreferences(array $data): void
    {
        try {
            $repository = app(SettingsRepository::class);
            $repository->updateUserSettings(auth()->id(), $data);

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
