<?php

// Currency/Http/Actions/GetCurrencySettingsAction.php

declare(strict_types=1);

namespace Modules\Currency\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Currency\Repositories\CurrencyRepository;

final class GetCurrencySettingsAction
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
    ) {}

    public function __invoke(): JsonResponse
    {
        $settings = $this->currencyRepository->getSettings();

        return response()->json([
            'success' => true,
            'settings' => $settings,
        ]);
    }
}
