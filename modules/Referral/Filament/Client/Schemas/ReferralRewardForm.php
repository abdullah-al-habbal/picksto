<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Client\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReferralRewardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Available Rewards')
                    ->components([
                        TextInput::make('reward_id')
                            ->label('Reward ID')
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }
}
