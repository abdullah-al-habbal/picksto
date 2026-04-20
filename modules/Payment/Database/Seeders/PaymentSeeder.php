<?php
// Payment/Database/Seeders/PaymentSeeder.php

declare(strict_types=1);

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Payment\Models\PaymentGatewayModel;

final class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $gateways = [
            [
                'name' => 'Manual Payment',
                'type' => 'manual',
                'description' => 'Pay via bank transfer or cash',
                'config' => json_encode([
                    'bank_name' => 'Al Rajhi Bank',
                    'account_number' => 'xxxx-xxxx-xxxx',
                    'iban' => 'SAxx xxxx xxxx xxxx xxxx xxxx',
                ]),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Stripe',
                'type' => 'stripe',
                'description' => 'Pay securely with credit card',
                'config' => json_encode(['test_mode' => true]),
                'is_active' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lemon Squeezy',
                'type' => 'lemonsqueezy',
                'description' => 'Global payments via Lemon Squeezy',
                'config' => json_encode(['webhook_secret' => '']),
                'is_active' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($gateways as $gateway) {
            PaymentGatewayModel::updateOrCreate(
                ['name' => $gateway['name']],
                $gateway
            );
        }
    }
}
