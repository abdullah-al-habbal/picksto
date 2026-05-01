<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Client\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('settings::settings.labels.notification_preferences'))
                    ->description(__('settings::settings.labels.manage_notifications'))
                    ->components([
                        Toggle::make('email_notifications')
                            ->label(__('settings::settings.labels.email_notifications'))
                            ->default(true),
                        Toggle::make('push_notifications')
                            ->label(__('settings::settings.labels.push_notifications'))
                            ->default(true),
                        Toggle::make('marketing_emails')
                            ->label(__('settings::settings.labels.marketing_emails'))
                            ->default(false),
                    ])
                    ->columns(1),
            ]);
    }
}
