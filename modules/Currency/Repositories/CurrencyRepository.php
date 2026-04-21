<?php
// Currency/Repositories/CurrencyRepository.php

declare(strict_types=1);

namespace Modules\Currency\Repositories;

use Modules\Currency\Models\CurrencySettingModel;

final class CurrencyRepository
{
    public function __construct(
        private readonly CurrencySettingModel $model,
    ) {}

    public function getSettings(): ?CurrencySettingModel
    {
        return $this->model->newQuery()->first();
    }

    public function updateSettings(array $data): CurrencySettingModel
    {
        $settings = $this->model->newQuery()->firstOrNew(['id' => 1]);

        $settings->fill([
            'code' => $data['code'],
            'symbol' => $data['symbol'],
            'name' => $data['name'],
            'decimal_places' => $data['decimalPlaces'],
            'decimal_separator' => $data['decimalSeparator'],
            'thousands_separator' => $data['thousandsSeparator'],
            'symbol_position' => $data['symbolPosition'],
            'space_between' => $data['spaceBetween'],
        ]);

        $settings->save();

        return $settings;
    }

    public function format(float $amount): string
    {
        $settings = $this->getSettings();

        if (! $settings) {
            return number_format($amount, 2);
        }

        return $settings->format($amount);
    }
}
