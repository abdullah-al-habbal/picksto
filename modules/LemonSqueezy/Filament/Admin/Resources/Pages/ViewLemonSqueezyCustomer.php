<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\LemonSqueezy\Filament\Admin\Resources\LemonSqueezyCustomerResource;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class ViewLemonSqueezyCustomer extends Page
{
    protected static string $resource = LemonSqueezyCustomerResource::class;

    protected static string $view = 'lemon-squeezy::filament.pages.view-api-record';

    public array $record = [];

    public array $subscriptions = [];

    public function mount(string | int $record): void
    {
        $repository = app(LemonSqueezyRepository::class);

        try {
            $this->record = $repository->getCustomer($record) ?? [];
            $this->subscriptions = $repository->getCustomerSubscriptions((int) $record) ?? [];
        } catch (\Exception $e) {
            $this->notify('error', 'Failed to fetch customer: ' . $e->getMessage());
            $this->record = [];
            $this->subscriptions = [];
        }
    }

    public function getTitle(): string | Htmlable
    {
        return $this->record['attributes']['email'] ?? __('Customer');
    }
}
