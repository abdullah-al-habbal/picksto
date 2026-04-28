<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\LemonSqueezy\Filament\Admin\Resources\LemonSqueezyCustomerResource;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class ListLemonSqueezyCustomers extends Page
{
    protected static string $resource = LemonSqueezyCustomerResource::class;

    protected static string $view = 'lemon-squeezy::filament.pages.list-api-records';

    public array $records = [];

    public function mount(): void
    {
        $repository = app(LemonSqueezyRepository::class);

        try {
            $this->records = $repository->getCustomers();
        } catch (\Exception $e) {
            $this->notify('error', 'Failed to fetch customers: ' . $e->getMessage());
            $this->records = [];
        }
    }

    public function getTitle(): string | Htmlable
    {
        return __('LemonSqueezy Customers');
    }
}
