<?php

// Settings/Models/SettingModel.php

declare(strict_types=1);

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $key_name
 * @property array|null $value
 * @property string $group
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class SettingModel extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key_name',
        'value',
        'group',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = self::newQuery()->where('key_name', $key)->first();

        return $setting?->value ?? $default;
    }

    public static function set(string $key, mixed $value, ?string $group = null, ?string $description = null): self
    {
        return self::newQuery()->updateOrCreate(
            ['key_name' => $key],
            [
                'value' => $value,
                'group' => $group ?? 'general',
                'description' => $description,
            ]
        );
    }
}
