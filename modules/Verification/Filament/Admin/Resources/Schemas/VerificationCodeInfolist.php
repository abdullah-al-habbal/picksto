<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class VerificationCodeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label(__('verification::verification.fields.user')),

                TextEntry::make('type')
                    ->label(__('verification::verification.fields.type'))
                    ->badge()
                    ->color('gray'),

                TextEntry::make('code')
                    ->label(__('verification::verification.fields.code'))
                    ->copyable(),

                TextEntry::make('status')
                    ->label(__('verification::verification.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        default => 'gray',
                    }),

                TextEntry::make('expires_at')
                    ->label(__('verification::verification.fields.expires_at'))
                    ->dateTime(),

                TextEntry::make('verified_at')
                    ->label(__('verification::verification.fields.verified_at'))
                    ->dateTime(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
