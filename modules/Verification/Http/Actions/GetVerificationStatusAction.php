<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Verification\Repositories\VerificationRepository;

final class GetVerificationStatusAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $status = $this->verificationRepository->getStatus($request->user()->id);

        return response()->json([
            'success' => true,
            'status' => $status,
        ]);
    }
}
