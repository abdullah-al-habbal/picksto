<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources;

use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ListLemonSqueezyCustomers;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ViewLemonSqueezyCustomer;

final class LemonSqueezyCustomerResource extends Resource
{
    protected static ?string $model = null;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function getNavigationGroup(): ?string
    {
        return 'Payment';
    }

    protected static ?int $navigationSort = 51;

    public static function getNavigationLabel(): string
    {
        return __('LemonSqueezy Customers');
    }

    public static function getModelLabel(): string
    {
        return __('Customer');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Customers');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('info')
                    ->content('This is a read-only view of LemonSqueezy customers. Data is fetched from the LemonSqueezy API.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('attributes.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('attributes.name')
                    ->label('Name')
                    ->sortable(),
                TextColumn::make('attributes.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('attributes.created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLemonSqueezyCustomers::route('/'),
            'view' => ViewLemonSqueezyCustomer::route('/{record}'),
        ];
    }
}
