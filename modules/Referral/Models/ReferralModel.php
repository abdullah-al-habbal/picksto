<?php

declare(strict_types=1);

namespace Modules\Referral\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $referrer_id
 * @property int $referred_id
 * @property Carbon $registered_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $referrer
 * @property-read UserModel $referred
 */
final class ReferralModel extends Model
{
    protected $table = 'referrals';

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'registered_at',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
        ];
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'referrer_id');
    }

    public function referred(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'referred_id');
    }
}
