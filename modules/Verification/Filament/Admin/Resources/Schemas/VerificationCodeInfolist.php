<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
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

                TextEntry::make('purpose')
                    ->label(__('verification::verification.fields.purpose'))
                    ->badge()
                    ->color('gray'),

                TextEntry::make('expires_at')
                    ->label(__('verification::verification.fields.expires_at'))
                    ->dateTime(),

                IconEntry::make('is_used')
                    ->label(__('verification::verification.fields.is_used'))
                    ->boolean(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
