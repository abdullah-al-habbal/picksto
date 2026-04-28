<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\LemonSqueezy\Filament\Admin\Resources\LemonSqueezyProductResource;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class ListLemonSqueezyProducts extends Page
{
    protected static string $resource = LemonSqueezyProductResource::class;

    protected string $view = 'lemon-squeezy::filament.pages.list-api-records';

    public array $records = [];

    public function mount(): void
    {
        $repository = app(LemonSqueezyRepository::class);

        try {
            $this->records = $repository->getProducts();
        } catch (\Exception $e) {
            $this->notify('error', 'Failed to fetch products: ' . $e->getMessage());
            $this->records = [];
        }
    }

    public function getTitle(): string | Htmlable
    {
        return __('LemonSqueezy Products');
    }
}
