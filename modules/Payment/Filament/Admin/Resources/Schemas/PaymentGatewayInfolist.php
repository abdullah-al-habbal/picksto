<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class PaymentGatewayInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('payment::payment.fields.name')),

                TextEntry::make('type')
                    ->label(__('payment::payment.fields.type'))
                    ->badge()
                    ->color('gray'),

                IconEntry::make('is_active')
                    ->label(__('payment::payment.fields.is_active'))
                    ->boolean(),

                TextEntry::make('description')
                    ->label(__('payment::payment.fields.description'))
                    ->columnSpanFull(),

                KeyValueEntry::make('config')
                    ->label(__('payment::payment.fields.config'))
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
