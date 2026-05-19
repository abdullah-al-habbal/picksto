<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Client\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;
use Modules\Product\Repositories\ProductRepository;

final class CatalogPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 3;

    protected string $view = 'product::filament.pages.catalog';

    public Collection $products;

    public function mount(ProductRepository $repository): void
    {
        $this->products = $repository->getActiveProducts();
    }

    public static function getNavigationLabel(): string
    {
        return __('product::product.labels.catalog');
    }

    public function getHeading(): string
    {
        return __('product::product.labels.catalog');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.content');
    }
}
