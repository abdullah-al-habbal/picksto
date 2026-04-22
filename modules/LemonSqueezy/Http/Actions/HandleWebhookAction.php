<?php

// modules/LemonSqueezy/Http/Actions/HandleWebhookAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class HandleWebhookAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(Request $request): Response
    {
        $signature = $request->header('X-Signature') ?? '';
        $payload = $request->all();

        try {
            $this->repository->handleWebhook($payload, $signature);

            return response(['received' => true], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Webhook handler failed'], 500);
        }
    }
}
