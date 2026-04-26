<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class DownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('download::download.fields.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('file_name')
                    ->label(__('download::download.fields.file_name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('source_url')
                    ->label(__('download::download.fields.source_url'))
                    ->required()
                    ->url()
                    ->maxLength(2048),

                TextInput::make('site')
                    ->label(__('download::download.fields.site'))
                    ->maxLength(255),

                Select::make('status')
                    ->label(__('download::download.fields.status'))
                    ->options([
                        'pending' => __('download::download.statuses.pending'),
                        'completed' => __('download::download.statuses.completed'),
                        'failed' => __('download::download.statuses.failed'),
                    ])
                    ->required(),

                TextInput::make('ip_address')
                    ->label(__('download::download.fields.ip_address'))
                    ->maxLength(45),
            ]);
    }
}
