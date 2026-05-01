<?php

declare(strict_types=1);

namespace Modules\Language\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

final class LanguageModel extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'is_default',
        'is_rtl',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_rtl' => 'boolean',
    ];

    public static function getDefault(): ?self
    {
        return self::where('is_default', true)->first();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
