<?php

declare(strict_types=1);

namespace Modules\Website\Handlers;

use Modules\Settings\Models\SettingModel;

final class GetSettingByKeyHandler
{
    public function handle(string $key, mixed $default = null): mixed
    {
        return SettingModel::get($key, $default);
    }
}
