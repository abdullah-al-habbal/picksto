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

                Select::make('status')
                    ->label(__('referral::referral.fields.status'))
                    ->options([
                        'pending' => __('referral::referral.statuses.pending'),
                        'claimed' => __('referral::referral.statuses.claimed'),
                        'expired' => __('referral::referral.statuses.expired'),
                    ])
                    ->required(),

                DateTimePicker::make('earned_at')
                    ->label(__('referral::referral.fields.earned_at')),

                DateTimePicker::make('claimed_at')
                    ->label(__('referral::referral.fields.claimed_at')),

                DateTimePicker::make('expires_at')
                    ->label(__('referral::referral.fields.expires_at')),
            ]);
    }
}
