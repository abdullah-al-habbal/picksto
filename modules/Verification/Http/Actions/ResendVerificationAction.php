<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Verification\Http\Requests\ResendVerificationRequest;
use Modules\Verification\Repositories\VerificationRepository;

final class ResendVerificationAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(ResendVerificationRequest $request): JsonResponse
    {
        $type = $request->validated('type');
        $purpose = $request->validated('purpose');

        $result = $type === 'email'
            ? $this->verificationRepository->sendEmailVerification($request->user()->id, $purpose)
            : $this->verificationRepository->sendWhatsAppVerification($request->user()->id, $purpose);

        return response()->json($result);
    }
}
