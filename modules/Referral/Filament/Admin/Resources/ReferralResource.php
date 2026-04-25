<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Referral\Filament\Admin\Resources\Pages\CreateReferral;
use Modules\Referral\Filament\Admin\Resources\Pages\EditReferral;
use Modules\Referral\Filament\Admin\Resources\Pages\ListReferrals;
use Modules\Referral\Filament\Admin\Resources\Pages\ViewReferral;
use Modules\Referral\Filament\Admin\Resources\Schemas\ReferralForm;
use Modules\Referral\Filament\Admin\Resources\Schemas\ReferralInfolist;
use Modules\Referral\Filament\Admin\Resources\Tables\ReferralsTable;
use Modules\Referral\Models\ReferralModel;

final class ReferralResource extends Resource
{
    protected static ?string $model = ReferralModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.referral');
    }

    public static function getNavigationLabel(): string
    {
        return __('referral::referral.labels.referrals');
    }

    public static function getModelLabel(): string
    {
        return __('referral::referral.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('referral::referral.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return '#' . $record->id . ' – ' . ($record->referrer?->name ?? '');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.referral.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return ReferralForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReferralInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferralsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReferrals::route('/'),
            'create' => CreateReferral::route('/create'),
            'view' => ViewReferral::route('/{record}'),
            'edit' => EditReferral::route('/{record}/edit'),
        ];
    }
}
