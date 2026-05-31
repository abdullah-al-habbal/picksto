<?php

declare(strict_types=1);

namespace Modules\Website\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

final class WebsitePageModel extends Model
{
    use HasTranslations;

    protected $table = 'website_pages';

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta_description',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'content' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
