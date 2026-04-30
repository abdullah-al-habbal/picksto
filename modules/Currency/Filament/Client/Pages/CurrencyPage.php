<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Client\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Modules\Currency\Repositories\CurrencyRepository;
use Modules\Currency\Filament\Client\Schemas\CurrencyForm;

final class CurrencyPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Currency';
    protected static ?int $navigationSort = 11;
    protected string $view = 'currency::filament.pages.currency';

    public ?array $data = [];

    public function mount(): void
    {
        $repository = app(CurrencyRepository::class);
        // fix:
        $settings = $repository->getUserCurrencySetting(auth()->id());

        $this->form->fill([
            'currency' => $settings['currency'] ?? 'USD',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema)
            ->statePath('data')
            ->live()
            ->afterStateUpdated(fn () => $this->save());
    }

    public function save(): void
    {
        try {
            $repository = app(CurrencyRepository::class);
            // fix:
            $repository->updateUserCurrencySetting(auth()->id(), $this->form->getState());

            Notification::make()
                ->success()
                ->title('Currency Updated')
                ->body('Your currency preference has been saved.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Failed to update currency setting.')
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Account';
    }
}
