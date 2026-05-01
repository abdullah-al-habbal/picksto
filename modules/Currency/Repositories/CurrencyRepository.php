<?php

// Currency/Repositories/CurrencyRepository.php

declare(strict_types=1);

namespace Modules\Currency\Repositories;

use Modules\Currency\Models\CurrencySettingModel;

use Modules\User\Models\UserModel;

final class CurrencyRepository
{
    public function __construct(
        private readonly CurrencySettingModel $model,
    ) {}

    public function getSettings(): ?CurrencySettingModel
    {
        return $this->model->newQuery()->first();
    }

    public function getUserCurrencySetting(int $userId): array
    {
        $user = UserModel::find($userId);
        return $user->settings['currency_settings'] ?? ['currency' => 'USD'];
    }

    public function updateUserCurrencySetting(int $userId, array $data): void
    {
        $user = UserModel::find($userId);
        $settings = $user->settings ?? [];
        $settings['currency_settings'] = $data;
        $user->settings = $settings;
        $user->save();
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

    public function format(float $amount, ?int $userId = null): string
    {
        $settings = $this->getSettings();

        if (! $settings) {
            return number_format($amount, 2);
        }

        // TODO: In a real app, we would convert the amount based on user's preferred currency rate
        // For now, we just use the global formatter but could adjust based on user preference if needed

        return $settings->format($amount);
    }
}
