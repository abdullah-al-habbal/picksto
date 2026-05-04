<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Modules\Product\Models\ProductModel;
use Modules\Package\Models\PackageModel;

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

                TextInput::make('original_url')
                    ->label(__('download::download.fields.original_url'))
                    ->required()
                    ->url()
                    ->maxLength(2048),

                TextInput::make('site_source')
                    ->label(__('download::download.fields.site_source'))
                    ->maxLength(255),

                Select::make('downloadable_type')
                    ->options([
                        'product' => 'Product',
                        'package' => 'Package',
                    ])
                    ->live(),

                Select::make('downloadable_id')
                    ->options(function (callable $get) {
                        $type = $get('downloadable_type');
                        if ($type === 'product') {
                            return ProductModel::pluck('name', 'id');
                        }
                        if ($type === 'package') {
                            return PackageModel::pluck('name', 'id');
                        }
                        return [];
                    })
                    ->searchable(),

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
