<?php

// Currency/Presenters/CurrencyPresenter.php

declare(strict_types=1);

namespace Modules\Currency\Presenters;

use Modules\Currency\Models\CurrencySettingModel;

final class CurrencyPresenter
{
    public function present(CurrencySettingModel $settings): array
    {
        return [
            'code' => $settings->code,
            'symbol' => $settings->symbol,
            'name' => $settings->name,
            'decimalPlaces' => $settings->decimal_places,
            'decimalSeparator' => $settings->decimal_separator,
            'thousandsSeparator' => $settings->thousands_separator,
            'symbolPosition' => $settings->symbol_position,
            'spaceBetween' => $settings->space_between,
        ];
    }
}
