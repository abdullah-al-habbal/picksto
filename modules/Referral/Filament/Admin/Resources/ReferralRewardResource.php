<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Referral\Filament\Admin\Resources\Pages\EditReferralReward;
use Modules\Referral\Filament\Admin\Resources\Pages\ListReferralRewards;
use Modules\Referral\Filament\Admin\Resources\Pages\ViewReferralReward;
use Modules\Referral\Filament\Admin\Resources\Schemas\ReferralRewardForm;
use Modules\Referral\Filament\Admin\Resources\Tables\ReferralRewardsTable;
use Modules\Referral\Models\ReferralRewardModel;

final class ReferralRewardResource extends Resource
{
    protected static ?string $model = ReferralRewardModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-gift';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.referral');
    }

    public static function getNavigationLabel(): string
    {
        return __('referral::referral.labels.rewards');
    }

    public static function getModelLabel(): string
    {
        return __('referral::referral.labels.reward_singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('referral::referral.labels.rewards');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return '#' . $record->id . ' – ' . ($record->user?->name ?? '');
    }

    public static function form(Schema $schema): Schema
    {
        return ReferralRewardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferralRewardsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReferralRewards::route('/'),
            'view' => ViewReferralReward::route('/{record}'),
            'edit' => EditReferralReward::route('/{record}/edit'),
        ];
    }
}
