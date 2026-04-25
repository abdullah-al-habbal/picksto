<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Filament\Admin\Resources\Pages\CreatePaymentGateway;
use Modules\Payment\Filament\Admin\Resources\Pages\EditPaymentGateway;
use Modules\Payment\Filament\Admin\Resources\Pages\ListPaymentGateways;
use Modules\Payment\Filament\Admin\Resources\Pages\ViewPaymentGateway;
use Modules\Payment\Filament\Admin\Resources\Schemas\PaymentGatewayForm;
use Modules\Payment\Filament\Admin\Resources\Schemas\PaymentGatewayInfolist;
use Modules\Payment\Filament\Admin\Resources\Tables\PaymentGatewaysTable;
use Modules\Payment\Models\PaymentGatewayModel;

final class PaymentGatewayResource extends Resource
{
    protected static ?string $model = PaymentGatewayModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('payment::payment.labels.gateways');
    }

    public static function getModelLabel(): string
    {
        return __('payment::payment.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('payment::payment.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->name;
    }

    public static function form(Schema $schema): Schema
    {
        return PaymentGatewayForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PaymentGatewayInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentGatewaysTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentGateways::route('/'),
            'create' => CreatePaymentGateway::route('/create'),
            'view' => ViewPaymentGateway::route('/{record}'),
            'edit' => EditPaymentGateway::route('/{record}/edit'),
        ];
    }
}
