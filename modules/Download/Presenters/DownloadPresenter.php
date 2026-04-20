<?php
// modules/Download/Presenters/DownloadPresenter.php

declare(strict_types=1);

namespace Modules\Download\Presenters;

use Modules\Download\Models\DownloadModel;

final class DownloadPresenter
{
    public function presentList(DownloadModel $download): array
    {
        return [
            'id' => $download->id,
            'url' => $download->original_url,
            'fileName' => $download->file_name,
            'site' => $download->site_source,
            'status' => $download->status,
            'date' => $download->created_at->format('Y-m-d H:i'),
            'downloadLink' => $download->download_path ? url($download->download_path) : null,
        ];
    }

    public function presentAdminList(DownloadModel $download): array
    {
        return [
            'id' => $download->id,
            'user' => [
                'name' => $download->user?->name,
                'email' => $download->user?->email,
            ],
            'url' => $download->original_url,
            'fileName' => $download->file_name,
            'site' => $download->site_source,
            'status' => $download->status,
            'ip' => $download->ip_address,
            'date' => $download->created_at->format('Y-m-d H:i'),
        ];
    }
}
