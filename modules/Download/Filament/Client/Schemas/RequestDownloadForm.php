<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Client\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class RequestDownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->label(__('download::download.fields.source_url'))
                    ->placeholder('https://www.freepik.com/...')
                    ->required()
                    ->url()
                    ->suffixAction(
                        Action::make('request')
                            ->label(__('download::download.labels.download'))
                            ->icon('heroicon-m-magnifying-glass')
                            ->action(fn ($livewire) => $livewire->submitDownloadRequest())
                    ),
            ]);
    }
}
