<?php
// modules/Currency/Repositories/CurrencyRepository.php
declare(strict_types=1);

namespace Modules\Currency\Repositories;

use Modules\Currency\Models\CurrencySettingModel;
use Modules\User\Models\UserSettingModel;

final class CurrencyRepository
{
    public function __construct(
        private readonly CurrencySettingModel $model,
    ) {
    }

    public function getSettings(): ?CurrencySettingModel
    {
        return $this->model->newQuery()->first();
    }

    public function getUserCurrencySetting(int $userId): array
    {
        $userSetting = UserSettingModel::with('currency')->where('user_id', $userId)->first();
        $currencyCode = $userSetting?->currency?->code ?? 'USD';
        return ['currency' => $currencyCode];
    }
    public function updateUserCurrencySetting(int $userId, array $data): void
    {
        $currencyId = $data['currency_id'] ?? null;

        // Form sends 'currency' as a code string (e.g. 'USD'); resolve to ID
        if (!$currencyId && isset($data['currency'])) {
            $currency = $this->model->newQuery()
                ->where('code', $data['currency'])
                ->first();
            $currencyId = $currency?->id;
        }

        UserSettingModel::updateOrCreate(
            ['user_id' => $userId],
            ['currency_id' => $currencyId]
        );
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

        if (!$settings) {
            return number_format($amount, 2);
        }
        return $settings->format($amount);
    }
}
