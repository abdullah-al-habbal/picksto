<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Modules\Package\Models\PackageModel;
use Modules\User\Repositories\UserRepository;

final class UserActions
{
    public static function changeRole(): Action
    {
        return Action::make('change_role')
            ->label(__('user::actions.change_role'))
            ->icon('heroicon-o-shield-check')
            ->form([
                Select::make('role')
                    ->label(__('dashboard.resources.user.fields.role'))
                    ->options([
                        'admin' => 'Admin',
                        'supervisor' => 'Supervisor',
                        'user' => 'User',
                    ])
                    ->required(),
            ])
            ->visible(fn () => auth()->user()?->role === 'admin')
            ->action(function (array $data, $record): void {
                app(UserRepository::class)->updateRole($record->id, $data['role']);
                Notification::make()
                    ->title(__('user::messages.role_updated'))
                    ->success()
                    ->send();
            });
    }

    public static function toggleBan(): Action
    {
        return Action::make('toggle_ban')
            ->label(fn ($record) => $record->is_banned
                ? __('user::actions.unban')
                : __('user::actions.ban'))
            ->icon(fn ($record) => $record->is_banned ? 'heroicon-o-lock-open' : 'heroicon-o-lock-closed')
            ->color(fn ($record) => $record->is_banned ? 'success' : 'danger')
            ->form([
                Toggle::make('is_banned')
                    ->label(__('user::fields.is_banned'))
                    ->default(fn ($record) => ! $record->is_banned),
            ])
            ->action(function (array $data, $record): void {
                $newStatus = (bool) $data['is_banned'];
                app(UserRepository::class)->updateBanStatus($record->id, $newStatus);
                $message = $newStatus
                    ? __('user::messages.user_banned')
                    : __('user::messages.user_unbanned');
                Notification::make()
                    ->title($message)
                    ->success()
                    ->send();
            });
    }

    public static function activatePackage(): Action
    {
        return Action::make('activate_package')
            ->label(__('user::actions.activate_package'))
            ->icon('heroicon-o-gift')
            ->form([
                Select::make('packageId')
                    ->label(__('dashboard.resources.package.navigation.singular'))
                    ->options(PackageModel::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('durationDays')
                    ->label(__('user::fields.duration_days'))
                    ->numeric()
                    ->min(1)
                    ->max(365)
                    ->default(30)
                    ->required(),
            ])
            ->visible(fn () => auth()->user()?->role === 'admin')
            ->action(function (array $data, $record): void {
                app(UserRepository::class)->activatePackage(
                    $record->id,
                    (int) $data['packageId'],
                    (int) $data['durationDays']
                );
                Notification::make()
                    ->title(__('user::messages.package_activated', ['days' => $data['durationDays']]))
                    ->success()
                    ->send();
            });
    }
}
