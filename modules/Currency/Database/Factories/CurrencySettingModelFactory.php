<?php

// Currency/Database/Factories/CurrencySettingModelFactory.php

declare(strict_types=1);

namespace Modules\Currency\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Currency\Models\CurrencySettingModel;

final class CurrencySettingModelFactory extends Factory
{
    protected $model = CurrencySettingModel::class;

    public function definition(): array
    {
        return [
            'code' => 'SAR',
            'symbol' => 'ر.س',
            'name' => 'Saudi Riyal',
            'decimal_places' => 2,
            'decimal_separator' => '.',
            'thousands_separator' => ',',
            'symbol_position' => true,
            'space_between' => false,
        ];
    }

    public function usd(): static
    {
        return $this->state(fn(array $attributes): array => [
            'code' => 'USD',
            'symbol' => '$',
            'name' => 'US Dollar',
            'symbol_position' => true,
        ]);
    }

    public function eur(): static
    {
        return $this->state(fn(array $attributes): array => [
            'code' => 'EUR',
            'symbol' => '€',
            'name' => 'Euro',
            'symbol_position' => false,
            'space_between' => true,
        ]);
    }
}
