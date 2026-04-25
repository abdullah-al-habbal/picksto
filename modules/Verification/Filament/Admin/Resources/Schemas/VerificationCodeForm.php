<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class VerificationCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('verification::verification.fields.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('type')
                    ->label(__('verification::verification.fields.type'))
                    ->options([
                        'email' => __('verification::verification.types.email'),
                        'whatsapp' => __('verification::verification.types.whatsapp'),
                    ])
                    ->required(),

                TextInput::make('code')
                    ->label(__('verification::verification.fields.code'))
                    ->required()
                    ->length(6),

                Select::make('status')
                    ->label(__('verification::verification.fields.status'))
                    ->options([
                        'pending' => __('verification::verification.statuses.pending'),
                        'verified' => __('verification::verification.statuses.verified'),
                        'expired' => __('verification::verification.statuses.expired'),
                    ])
                    ->required(),

                DateTimePicker::make('expires_at')
                    ->label(__('verification::verification.fields.expires_at'))
                    ->required(),

                DateTimePicker::make('verified_at')
                    ->label(__('verification::verification.fields.verified_at')),
            ]);
    }
}
