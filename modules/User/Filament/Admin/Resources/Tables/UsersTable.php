<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Modules\User\Filament\Admin\Actions\UserActions;

final class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('dashboard.resources.user.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(__('dashboard.resources.user.fields.email'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label(__('dashboard.resources.user.fields.role'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'supervisor' => 'warning',
                        'user' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('phone')
                    ->label(__('dashboard.resources.user.fields.phone'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('is_banned')
                    ->label(__('dashboard.resources.user.fields.is_banned'))
                    ->badge()
                    ->state(fn($record): string => $record->is_banned ? __('dashboard.resources.user.fields.banned') : __('dashboard.resources.user.fields.active'))
                    ->color(fn($record): string => $record->is_banned ? 'danger' : 'success')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('last_login_at')
                    ->label(__('dashboard.resources.user.fields.last_login_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label(__('dashboard.resources.user.fields.role'))
                    ->options([
                        'admin' => 'Admin',
                        'supervisor' => 'Supervisor',
                        'user' => 'User',
                    ]),
                TernaryFilter::make('is_banned')
                    ->label(__('dashboard.resources.user.fields.is_banned'))
                    ->placeholder(__('dashboard.fields.all'))
                    ->trueLabel(__('dashboard.resources.user.fields.banned'))
                    ->falseLabel(__('dashboard.resources.user.fields.active')),
                TernaryFilter::make('email_verified')
                    ->label(__('dashboard.resources.user.fields.email_verified'))
                    ->placeholder(__('dashboard.fields.all'))
                    ->trueLabel(__('dashboard.resources.user.fields.verified'))
                    ->falseLabel(__('dashboard.resources.user.fields.unverified')),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                UserActions::changeRole(),
                UserActions::toggleBan(),
                UserActions::activatePackage(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading(__('dashboard.resources.user.empty_state'));
    }
}
