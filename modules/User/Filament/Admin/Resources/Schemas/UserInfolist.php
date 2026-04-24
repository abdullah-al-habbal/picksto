<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('dashboard.resources.user.fields.name')),
                TextEntry::make('email')
                    ->label(__('dashboard.resources.user.fields.email')),
                TextEntry::make('phone')
                    ->label(__('dashboard.resources.user.fields.phone'))
                    ->placeholder('-'),
                TextEntry::make('role')
                    ->label(__('dashboard.resources.user.fields.role'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'supervisor' => 'warning',
                        'user' => 'success',
                        default => 'gray',
                    }),
                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label(__('dashboard.fields.updated_at'))
                    ->dateTime(),
            ]);
    }
}
