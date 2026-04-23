<?php

// modules/Package/Models/PackageModel.php

declare(strict_types=1);

namespace Modules\Package\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Package\Database\Factories\PackageModelFactory;
use Modules\Subscription\Models\SubscriptionModel;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property array<string, string> $name
 * @property array<string, string>|null $description
 * @property float $price
 * @property string $currency
 * @property int $daily_limit
 * @property int $monthly_limit
 * @property array|null $allowed_sites
 * @property int $duration_days
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read HasMany<SubscriptionModel, int> $subscriptions
 */
final class PackageModel extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'daily_limit',
        'monthly_limit',
        'allowed_sites',
        'duration_days',
        'is_active',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'description' => 'array',
            'price' => 'decimal:2',
            'daily_limit' => 'integer',
            'monthly_limit' => 'integer',
            'allowed_sites' => 'array',
            'duration_days' => 'integer',
            'is_active' => 'boolean',
        ];
    }

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
}
