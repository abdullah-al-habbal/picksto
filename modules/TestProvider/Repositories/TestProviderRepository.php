<?php

declare(strict_types=1);

namespace Modules\TestProvider\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class TestProviderRepository
{
    private string $baseUrl;
    private string $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.browser.url', 'http://127.0.0.1:4000');
        $this->secret = config('services.browser.secret', '');
    }

    public function testProvider(array $provider, string $testUrl): array
    {
        $startTime = microtime(true);

        $downloaderType = 'NirvanaStock';
        if (!empty($provider['providerUrl']) && str_contains($provider['providerUrl'], 'freepik.com')) {
            $downloaderType = 'Freepik';
        }

        $response = Http::withHeaders([
            'X-API-Secret' => $this->secret,
        ])
            ->timeout(300)
            ->post("{$this->baseUrl}/api/test-provider", [
                'siteSource' => $downloaderType,
                'providerConfig' => [
                    'email' => $provider['email'],
                    'password' => $provider['password'],
                    'loginUrl' => $provider['providerUrl'] ?? null,
                ],
                'url' => $testUrl,
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException(__('testprovider::errors.microservice_failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]));
        }

        $result = $response->json();
        $duration = (int) ((microtime(true) - $startTime) * 1000);

        Log::info('TestProvider completed', [
            'downloaderType' => $downloaderType,
            'duration' => $duration,
            'downloadLink' => $result['data']['downloadPath'] ?? null,
        ]);

        return [
            'duration' => $duration,
            'downloadLink' => $result['data']['downloadPath'] ?? '',
            'downloaderType' => $downloaderType,
        ];
    }

    public function testCustomBot(array $provider, string $testUrl): array
    {
        $startTime = microtime(true);

        $response = Http::withHeaders([
            'X-API-Secret' => $this->secret,
        ])
            ->timeout(600) // 10 minutes for complex custom bots
            ->post("{$this->baseUrl}/api/test-custom-bot", [
                'credentials' => [
                    'email' => $provider['email'],
                    'password' => $provider['password'],
                ],
                'steps' => $provider['customSteps'] ?? [],
                'url' => $testUrl,
            ]);

        if (!$response->successful()) {
            throw new \RuntimeException(__('testprovider::errors.microservice_failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]));
        }

        $result = $response->json();
        $duration = (int) ((microtime(true) - $startTime) * 1000);

        Log::info('TestCustomBot completed', [
            'stepsExecuted' => count($provider['customSteps'] ?? []),
            'duration' => $duration,
            'downloadLink' => $result['data']['downloadPath'] ?? null,
        ]);

        return [
            'duration' => $duration,
            'downloadLink' => $result['data']['downloadPath'] ?? '',
            'stepsExecuted' => count($provider['customSteps'] ?? []),
        ];
    }
}
