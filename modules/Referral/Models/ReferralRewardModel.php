<?php

declare(strict_types=1);

namespace Modules\Referral\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $user_id
 * @property 'pending'|'claimed'|'expired' $status
 * @property Carbon $earned_at
 * @property Carbon $expires_at
 * @property Carbon|null $claimed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $user
 */
final class ReferralRewardModel extends Model
{
    protected $table = 'referral_rewards';

    protected $fillable = [
        'user_id',
        'status',
        'earned_at',
        'expires_at',
        'claimed_at',
    ];

    protected function casts(): array
    {
        return [
            'earned_at' => 'datetime',
            'expires_at' => 'datetime',
            'claimed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeClaimed(Builder $query): Builder
    {
        return $query->where('status', 'claimed');
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast() && $this->status !== 'claimed';
    }
}
