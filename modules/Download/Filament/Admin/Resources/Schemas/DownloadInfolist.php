<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class DownloadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label(__('download::download.fields.user')),

                TextEntry::make('file_name')
                    ->label(__('download::download.fields.file_name')),

                TextEntry::make('source_url')
                    ->label(__('download::download.fields.source_url'))
                    ->url()
                    ->openUrlInNewTab(),

                TextEntry::make('site')
                    ->label(__('download::download.fields.site'))
                    ->badge()
                    ->color('gray'),

                TextEntry::make('status')
                    ->label(__('download::download.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    }),

                TextEntry::make('ip_address')
                    ->label(__('download::download.fields.ip_address')),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
