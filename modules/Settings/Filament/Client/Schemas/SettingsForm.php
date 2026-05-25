<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Client\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('notify_email_enabled')
                    ->label(__('settings::settings.labels.email_notifications'))
                    ->default(true),

                Toggle::make('notify_whatsapp_enabled')
                    ->label(__('settings::settings.labels.push_notifications'))
                    ->default(false),
            ]);
    }
}
}
