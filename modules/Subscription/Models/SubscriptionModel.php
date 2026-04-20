<?php
// modules/Subscription/Models/SubscriptionModel.php

declare(strict_types=1);

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Database\Factories\SubscriptionModelFactory;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $user_id
 * @property int $package_id
 * @property 'pending'|'active'|'expired'|'cancelled' $status
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property int $downloads_today
 * @property int $downloads_month
 * @property Carbon|null $last_download_date
 * @property string|null $payment_method
 * @property string|null $transaction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $user
 * @property-read PackageModel $package
 */
final class SubscriptionModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'start_date',
        'end_date',
        'downloads_today',
        'downloads_month',
        'last_download_date',
        'payment_method',
        'transaction_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_download_date' => 'datetime',
        'downloads_today' => 'integer',
        'downloads_month' => 'integer',
    ];

    protected static function newFactory(): SubscriptionModelFactory
    {
        return SubscriptionModelFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageModel::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now());
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('status', 'active')
            ->where('end_date', '<', now());
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date?->isFuture();
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function canDownload(): bool
    {
        if (! $this->isActive()) {
            return false;
        }

        $package = $this->package;

        return $this->downloads_today < $package->daily_limit
            && $this->downloads_month < $package->monthly_limit;
    }

    public function incrementDownloadCounters(): void
    {
        $this->increment('downloads_today');
        $this->increment('downloads_month');
        $this->update(['last_download_date' => now()]);
    }

    public function resetDailyCounter(): void
    {
        $this->update(['downloads_today' => 0]);
    }

    public function getRemainingDownloadsTodayAttribute(): int
    {
        return max(0, $this->package->daily_limit - $this->downloads_today);
    }

    public function getRemainingDownloadsMonthAttribute(): int
    {
        return max(0, $this->package->monthly_limit - $this->downloads_month);
    }
}
