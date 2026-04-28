<?php

// modules/LemonSqueezy/Repositories/LemonSqueezyRepository.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class LemonSqueezyRepository
{
    public function createCheckout(int $userId, int $variantId, array $customData = []): string
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->post('https://api.lemonsqueezy.com/v1/checkouts', [
                'data' => [
                    'type' => 'checkouts',
                    'attributes' => [
                        'checkout_data' => [
                            'custom' => array_merge($customData, ['user_id' => $userId]),
                        ],
                    ],
                    'relationships' => [
                        'store' => ['data' => ['type' => 'stores', 'id' => config('services.lemonsqueezy.store_id')]],
                        'variant' => ['data' => ['type' => 'variants', 'id' => $variantId]],
                    ],
                ],
            ]);

        $response->throw();

        return $response->json('data.attributes.url');
    }

    public function getProducts(): array
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->get('https://api.lemonsqueezy.com/v1/products');

        $response->throw();

        return $response->json('data', []);
    }

    public function getProduct(int | string $productId): array
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->get("https://api.lemonsqueezy.com/v1/products/{$productId}");

        $response->throw();

        return $response->json('data', []);
    }

    public function getCustomers(): array
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->get('https://api.lemonsqueezy.com/v1/customers');

        $response->throw();

        return $response->json('data', []);
    }

    public function getCustomer(int $customerId): array
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->get("https://api.lemonsqueezy.com/v1/customers/{$customerId}");

        $response->throw();

        return $response->json('data', []);
    }

    public function getCustomerSubscriptions(int $customerId): array
    {
        $response = Http::timeout(30)
            ->withToken(config('services.lemonsqueezy.api_key'))
            ->get('https://api.lemonsqueezy.com/v1/subscriptions', [
                'filter[customer_id]' => $customerId,
            ]);

        $response->throw();

        return $response->json('data', []);
    }

    public function handleWebhook(array $payload, string $signature): void
    {
        $eventName = $payload['meta']['event_name'] ?? 'unknown';

        Log::info('LemonSqueezy Webhook', [
            'event' => $eventName,
            'payload' => $payload,
        ]);

    }
}
