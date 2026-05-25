<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

final class ReferralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('referrer_id')
                    ->label(__('referral::referral.fields.referrer'))
                    ->relationship('referrer', 'name')
                    ->searchable()
                    ->required(),

                Select::make('referred_id')
                    ->label(__('referral::referral.fields.referred'))
                    ->relationship('referred', 'name')
                    ->searchable()
                    ->required(),

                DateTimePicker::make('registered_at')
                    ->label(__('referral::referral.fields.registered_at'))
                    ->default(now()),
            ]);
    }
}
