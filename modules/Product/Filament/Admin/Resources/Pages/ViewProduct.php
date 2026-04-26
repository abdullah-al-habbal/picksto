<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Product\Filament\Admin\Resources\ProductResource;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;
}
