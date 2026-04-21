<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Verification\Http\Requests\UpdateSettingsRequest;
use Modules\Verification\Repositories\VerificationRepository;

final class UpdateAdminSettingsAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(UpdateSettingsRequest $request): JsonResponse
    {
        $this->verificationRepository->updateAdminSettings($request->validated());

        return response()->json([
            'success' => true,
            'message' => __('verification::messages.settings_updated'),
        ]);
    }
}
