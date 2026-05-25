<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class ReferralInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('referrer.name')
                    ->label(__('referral::referral.fields.referrer')),

                TextEntry::make('referred.name')
                    ->label(__('referral::referral.fields.referred')),

                TextEntry::make('registered_at')
                    ->label(__('referral::referral.fields.registered_at'))
                    ->dateTime(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}
