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

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 11;

    protected string $view = 'currency::filament.pages.currency';

    public ?array $data = [];

    public function mount(): void
    {
        $repository = app(CurrencyRepository::class);
        $settings = $repository->getUserCurrencySetting(auth()->id());

        $this->form->fill($settings);
    }

    public static function getNavigationLabel(): string
    {
        return __('currency::currency.labels.currencies');
    }

    public function getHeading(): string
    {
        return __('currency::currency.labels.currencies');
    }

    public function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema)
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $repository = app(CurrencyRepository::class);
            $repository->updateUserCurrencySetting(auth()->id(), $this->form->getState());

            Notification::make()
                ->success()
                ->title(__('currency::currency.messages.updated'))
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title(__('currency::currency.errors.update_failed'))
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.account');
    }
}
