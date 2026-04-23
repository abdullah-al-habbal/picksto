<?php

// modules/Package/Models/PackageModel.php

declare(strict_types=1);

namespace Modules\Package\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Package\Database\Factories\PackageModelFactory;
use Modules\Subscription\Models\SubscriptionModel;

/**
 * @property int $id
 * @property string $name_ar
 * @property string|null $name_en
 * @property string|null $description_ar
 * @property string|null $description_en
 * @property float $price
 * @property string $currency
 * @property int $daily_limit
 * @property int $monthly_limit
 * @property array|null $allowed_sites
 * @property int $duration_days
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read HasMany<SubscriptionModel, int> $subscriptions
 */
final class PackageModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'currency',
        'daily_limit',
        'monthly_limit',
        'allowed_sites',
        'duration_days',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'daily_limit' => 'integer',
        'monthly_limit' => 'integer',
        'allowed_sites' => 'array',
        'duration_days' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): PackageModelFactory
    {
        return PackageModelFactory::new();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionModel::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByPriceRange(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeSupportsSite(Builder $query, string $site): Builder
    {
        return $query->where(function (Builder $q) use ($site): void {
            $q->whereJsonContains('allowed_sites', 'All')
                ->orWhereJsonContains('allowed_sites', $site);
        });
    }

    public function supportsSite(string $site): bool
    {
        $allowed = $this->allowed_sites ?? [];

        return in_array('All', $allowed, true) || in_array($site, $allowed, true);
    }

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' && $this->name_ar
            ? $this->name_ar
            : ($this->name_en ?? $this->name_ar);
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' && $this->description_ar
            ? $this->description_ar
            : ($this->description_en ?? $this->description_ar);
    }
}
