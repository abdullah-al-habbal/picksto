<?php

declare(strict_types=1);

namespace Modules\Upload\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Models\SettingModel;
use Modules\User\Models\UserModel;

final class UploadRepository
{
    public function __construct(
        private readonly SettingModel $settingModel,
        private readonly UserModel $userModel,
    ) {}

    public function storeLogo(UploadedFile $file): array
    {
        $filename = uniqid('logo_').'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('logos', $filename, 'public');

        $currentConfig = SettingModel::get('site_config', []);
        if (! is_array($currentConfig)) {
            $currentConfig = json_decode($currentConfig, true) ?? [];
        }
        $currentConfig['logo'] = '/storage/'.$path;

        $this->settingModel::query()
            ->updateOrCreate(['key_name' => 'site_config'], ['value' => $currentConfig, 'group' => 'site']);

        return ['url' => '/storage/'.$path, 'filename' => $filename];
    }

    public function storeFavicon(UploadedFile $file): array
    {
        $filename = uniqid('favicon_').'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('favicons', $filename, 'public');

        $currentConfig = SettingModel::get('site_config', []);
        if (! is_array($currentConfig)) {
            $currentConfig = json_decode($currentConfig, true) ?? [];
        }
        $currentConfig['favicon'] = '/storage/'.$path;

        $this->settingModel::query()
            ->updateOrCreate(['key_name' => 'site_config'], ['value' => $currentConfig, 'group' => 'site']);

        return ['url' => '/storage/'.$path, 'filename' => $filename];
    }

    public function storeProductImage(UploadedFile $file): array
    {
        $filename = uniqid('product_').'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        $processedUrl = null;
        $processingInfo = null;

        try {
            $processingInfo = [
                'originalSize' => $file->getSize(),
                'processedSize' => $file->getSize(),
                'format' => 'original',
            ];
            $processedUrl = '/storage/'.$path;
        } catch (\Exception $e) {
            $processingInfo = ['error' => 'Processing failed'];
            $processedUrl = '/storage/'.$path;
        }

        return [
            'url' => $processedUrl,
            'filename' => $filename,
            'processing' => $processingInfo,
        ];
    }

    public function storeAvatar(UploadedFile $file, int $userId): array
    {
        $filename = uniqid('avatar_').'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('avatars', $filename, 'public');

        $this->userModel::where('id', $userId)->update(['avatar' => '/storage/'.$path]);

        return ['url' => '/storage/'.$path, 'filename' => $filename];
    }

    public function deleteFile(string $folder, string $filename): void
    {
        $allowedFolders = ['logos', 'favicons', 'products', 'avatars', 'thumbnails'];

        if (! in_array($folder, $allowedFolders)) {
            throw new \InvalidArgumentException(__('upload::errors.invalid_folder'));
        }

        $path = $folder.'/'.$filename;

        if (! Storage::disk('public')->exists($path)) {
            throw new \RuntimeException(__('upload::errors.file_not_found'));
        }

        Storage::disk('public')->delete($path);
    }
}
