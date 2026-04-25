<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class PaymentGatewayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('payment::payment.fields.name'))
                    ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->label(__('payment::payment.fields.type'))
                    ->options([
                        'stripe' => __('payment::payment.types.stripe'),
                        'paypal' => __('payment::payment.types.paypal'),
                        'lemonsqueezy' => __('payment::payment.types.lemonsqueezy'),
                        'manual' => __('payment::payment.types.manual'),
                    ])
                    ->required(),

                Toggle::make('is_active')
                    ->label(__('payment::payment.fields.is_active'))
                    ->default(true),

                Textarea::make('description')
                    ->label(__('payment::payment.fields.description'))
                    ->columnSpanFull(),

                KeyValue::make('config')
                    ->label(__('payment::payment.fields.config'))
                    ->columnSpanFull(),
            ]);
    }
}
