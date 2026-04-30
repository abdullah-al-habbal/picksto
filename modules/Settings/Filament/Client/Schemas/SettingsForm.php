<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Client\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Notification Preferences')
                    ->description('Manage how you receive notifications')
                    ->components([
                        Toggle::make('email_notifications')
                            ->label('Email Notifications')
                            ->default(true),
                        Toggle::make('push_notifications')
                            ->label('Push Notifications')
                            ->default(true),
                        Toggle::make('marketing_emails')
                            ->label('Marketing Emails')
                            ->default(false),
                    ])
                    ->columns(1),
            ]);
    }
}
