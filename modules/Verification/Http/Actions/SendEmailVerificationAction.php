<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Verification\Http\Requests\SendVerificationRequest;
use Modules\Verification\Repositories\VerificationRepository;

final class SendEmailVerificationAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(SendVerificationRequest $request): JsonResponse
    {
        $result = $this->verificationRepository->sendEmailVerification(
            $request->user()->id,
            $request->validated('purpose')
        );

        return response()->json($result);
    }
}
