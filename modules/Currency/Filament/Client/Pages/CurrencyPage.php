<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Client\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Currency\Repositories\CurrencyRepository;

final class CurrencyPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Currency';
    protected static ?int $navigationSort = 11;
    protected string $view = 'filament.pages.currency';

    public ?array $data = [];

    public function mount(): void
    {
        $repository = app(CurrencyRepository::class);
        $settings = $repository->getUserCurrencySetting(auth()->id());

        $this->form->fill([
            'currency' => $settings['currency'] ?? 'USD',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('currency')
                    ->label('Preferred Currency')
                    ->options([
                        'USD' => 'US Dollar (USD)',
                        'EUR' => 'Euro (EUR)',
                        'GBP' => 'British Pound (GBP)',
                        'JPY' => 'Japanese Yen (JPY)',
                        'CAD' => 'Canadian Dollar (CAD)',
                        'AUD' => 'Australian Dollar (AUD)',
                        'CHF' => 'Swiss Franc (CHF)',
                        'CNY' => 'Chinese Yuan (CNY)',
                        'INR' => 'Indian Rupee (INR)',
                        'MXN' => 'Mexican Peso (MXN)',
                    ])
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn () => $this->save()),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $repository = app(CurrencyRepository::class);
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
