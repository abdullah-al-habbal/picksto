<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\LemonSqueezy\Filament\Admin\Resources\LemonSqueezyProductResource;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class ViewLemonSqueezyProduct extends Page
{
    protected static string $resource = LemonSqueezyProductResource::class;

    protected string $view = 'lemon-squeezy::filament.pages.view-api-record';

    public array $record = [];

    public function mount(string|int $record): void
    {
        $repository = app(LemonSqueezyRepository::class);

        try {
            $this->record = $repository->getProduct($record) ?? [];
        } catch (\Exception $e) {
            $this->notify('error', 'Failed to fetch product: ' . $e->getMessage());
            $this->record = [];
        }
    }

    public function getTitle(): string|Htmlable
    {
        return $this->record['attributes']['name'] ?? __('Product');
    }
}
