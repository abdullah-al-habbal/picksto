<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;

final class LemonSqueezyProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('info')
                    ->content(__('lemonsqueezy::lemonsqueezy.products.messages.info')),
            ]);
    }
}
