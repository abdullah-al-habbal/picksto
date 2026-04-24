<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Filament\Admin\Resources\RelationManagers\SubscriptionsRelationManager;
use Modules\User\Filament\Admin\Resources\Pages\CreateUser;
use Modules\User\Filament\Admin\Resources\Pages\EditUser;
use Modules\User\Filament\Admin\Resources\Pages\ListUsers;
use Modules\User\Filament\Admin\Resources\Pages\ViewUser;
use Modules\User\Filament\Admin\Resources\Schemas\UserForm;
use Modules\User\Filament\Admin\Resources\Schemas\UserInfolist;
use Modules\User\Filament\Admin\Resources\Tables\UsersTable;
use Modules\User\Models\UserModel;

class UserResource extends Resource
{
    protected static ?string $model = UserModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.resources.user.navigation.label');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.resources.user.navigation.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.resources.user.navigation.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->name ?? '#'.$record->id;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.user.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubscriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
