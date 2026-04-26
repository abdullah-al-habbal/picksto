<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class PackageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('package::package.fields.name')),

                TextEntry::make('price')
                    ->label(__('package::package.fields.price'))
                    ->money(fn ($record) => $record->currency ?? 'USD'),

                TextEntry::make('duration_days')
                    ->label(__('package::package.fields.duration_days'))
                    ->suffix(' ' . __('package::package.labels.days')),

                TextEntry::make('daily_limit')
                    ->label(__('package::package.fields.daily_limit')),

                TextEntry::make('monthly_limit')
                    ->label(__('package::package.fields.monthly_limit')),

                TextEntry::make('allowed_sites')
                    ->label(__('package::package.fields.allowed_sites'))
                    ->badge()
                    ->color('gray'),

                IconEntry::make('is_active')
                    ->label(__('package::package.fields.is_active'))
                    ->boolean(),

                TextEntry::make('description')
                    ->label(__('package::package.fields.description'))
                    ->html()
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
