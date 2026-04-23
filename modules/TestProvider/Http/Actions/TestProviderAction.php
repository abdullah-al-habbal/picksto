<?php

declare(strict_types=1);

namespace Modules\TestProvider\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\TestProvider\Http\Requests\TestProviderRequest;
use Modules\TestProvider\Repositories\TestProviderRepository;

final class TestProviderAction
{
    public function __construct(
        private readonly TestProviderRepository $testProviderRepository,
    ) {}

    public function __invoke(TestProviderRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            // Enable browser visibility for testing
            DB::table('settings')
                ->where('key_name', 'site_config')
                ->update([
                    'value' => DB::raw("JSON_SET(value, '$.botBrowserVisible', true)"),
                ]);

            $result = $this->testProviderRepository->testProvider(
                $request->validated('provider'),
                $request->validated('testUrl')
            );

            // Reset browser visibility
            DB::table('settings')
                ->where('key_name', 'site_config')
                ->update([
                    'value' => DB::raw("JSON_SET(value, '$.botBrowserVisible', false)"),
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'status' => 'completed',
                'duration' => $result['duration'],
                'message' => __('testprovider::messages.test_success', ['link' => substr($result['downloadLink'], 0, 60)]),
                'downloadLink' => $result['downloadLink'],
                'downloaderType' => $result['downloaderType'],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Ensure browser visibility is reset on error
            try {
                DB::table('settings')
                    ->where('key_name', 'site_config')
                    ->update([
                        'value' => DB::raw("JSON_SET(value, '$.botBrowserVisible', false)"),
                    ]);
            } catch (\Exception $resetError) {
                // Log reset error but don't override original error
            }

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'stack' => app()->environment('development') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }
}
