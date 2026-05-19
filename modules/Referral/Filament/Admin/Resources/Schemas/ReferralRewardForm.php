<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

final class ReferralRewardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('referral::referral.fields.user'))
                    ->relationship('user', 'name')
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
                    ->label(__('referral::referral.fields.earned_at'))
                    ->required(),

                DateTimePicker::make('expires_at')
                    ->label(__('referral::referral.fields.expires_at'))
                    ->required(),

                DateTimePicker::make('claimed_at')
                    ->label(__('referral::referral.fields.claimed_at')),
            ]);
    }
}
