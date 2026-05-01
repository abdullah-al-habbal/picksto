<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Client\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Modules\Payment\Repositories\PaymentRepository;

final class RequestSubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('gatewayId')
                    ->label(__('payment::payment.fields.gateway'))
                    ->options(function () {
                        $repository = app(PaymentRepository::class);
                        return $repository->getActiveGateways()->pluck('name', 'id');
                    })
                    ->required()
                    ->native(false),

                Textarea::make('userNotes')
                    ->label(__('payment::payment.fields.user_notes'))
                    ->placeholder('Any additional information...')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
