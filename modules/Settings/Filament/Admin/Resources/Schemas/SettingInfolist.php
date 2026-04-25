<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class SettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('key')
                    ->label(__('settings::settings.fields.key')),

                TextEntry::make('value')
                    ->label(__('settings::settings.fields.value')),

                TextEntry::make('group')
                    ->label(__('settings::settings.fields.group')),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
