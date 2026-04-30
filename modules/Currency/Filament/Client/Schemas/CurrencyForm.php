<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Client\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->required(),
            ]);
    }
}
