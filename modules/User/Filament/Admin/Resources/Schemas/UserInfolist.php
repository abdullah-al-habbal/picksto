<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
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
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'supervisor' => 'warning',
                        'user' => 'success',
                        default => 'gray',
                    }),

                ImageEntry::make('avatar')
                    ->label(__('dashboard.resources.user.fields.avatar'))
                    ->circular(),

                TextEntry::make('is_banned')
                    ->label(__('dashboard.resources.user.fields.is_banned'))
                    ->badge()
                    ->state(fn($record): string => $record->is_banned ? __('dashboard.resources.user.fields.banned') : __('dashboard.resources.user.fields.active'))
                    ->color(fn($record): string => $record->is_banned ? 'danger' : 'success'),

                IconEntry::make('email_verified')
                    ->label(__('dashboard.resources.user.fields.email_verified'))
                    ->boolean(),

                IconEntry::make('phone_verified')
                    ->label(__('dashboard.resources.user.fields.phone_verified'))
                    ->boolean(),

                TextEntry::make('referral_code')
                    ->label(__('dashboard.resources.user.fields.referral_code'))
                    ->copyable(),

                TextEntry::make('profession')
                    ->label(__('dashboard.resources.user.fields.profession'))
                    ->placeholder('-'),

                TextEntry::make('company_size')
                    ->label(__('dashboard.resources.user.fields.company_size'))
                    ->placeholder('-'),

                TextEntry::make('last_login_at')
                    ->label(__('dashboard.resources.user.fields.last_login_at'))
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label(__('dashboard.fields.updated_at'))
                    ->dateTime(),
            ]);
    }
}
