<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use Modules\Analytics\Services\DashboardStatsService;

final class DownloadStatsWidget extends Widget
{
    protected string $view = 'analytics::widgets.download-stats-widget';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'stats' => app(DashboardStatsService::class)->getDownloadStats(),
        ];
    }
}
