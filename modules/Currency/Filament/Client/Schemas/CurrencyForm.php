<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Client\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

final class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('currency')
                    ->label(__('currency::currency.labels.singular'))
                    ->options([
                        'USD' => 'US Dollar (USD)',
                        'EUR' => 'Euro (EUR)',
                        'SAR' => 'Saudi Riyal (SAR)',
                        'EGP' => 'Egyptian Pound (EGP)',
                        'AED' => 'United Arab Emirates Dirham (AED)',
                        'GBP' => 'British Pound (GBP)',
                        'TRY' => 'Turkish Lira (TRY)',
                        'KWD' => 'Kuwaiti Dinar (KWD)',
                        'QAR' => 'Qatari Rial (QAR)',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }
}
