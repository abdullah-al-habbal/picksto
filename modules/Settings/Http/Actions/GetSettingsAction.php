<?php

// Settings/Http/Actions/GetSettingsAction.php

declare(strict_types=1);

namespace Modules\Settings\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Settings\Repositories\SettingsRepository;

final class GetSettingsAction
{
    public function __construct(
        private readonly SettingsRepository $settingsRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $isAdmin = $request->user()?->role === 'admin';
        $settings = $this->settingsRepository->getSettings($isAdmin);

        return response()->json([
            'success' => true,
            'settings' => $settings,
        ]);
    }
}
