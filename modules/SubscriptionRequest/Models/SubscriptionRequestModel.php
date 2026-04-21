<?php

// SubscriptionRequest/Models/SubscriptionRequestModel.php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\Package\Models\PackageModel;
use Modules\Payment\Models\PaymentGatewayModel;
use Modules\SubscriptionRequest\Database\Factories\SubscriptionRequestModelFactory;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $user_id
 * @property int $package_id
 * @property int|null $gateway_id
 * @property 'pending'|'approved'|'rejected'|'completed' $status
 * @property string|null $transaction_id
 * @property float|null $amount
 * @property string $currency
 * @property string|null $admin_notes
 * @property string|null $user_notes
 * @property Carbon|null $approved_at
 * @property int|null $approved_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $user
 * @property-read PackageModel $package
 * @property-read PaymentGatewayModel|null $gateway
 * @property-read UserModel|null $approver
 */
final class SubscriptionRequestModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'gateway_id',
        'status',
        'transaction_id',
        'amount',
        'currency',
        'admin_notes',
        'user_notes',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    protected static function newFactory(): SubscriptionRequestModelFactory
    {
        return SubscriptionRequestModelFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageModel::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(PaymentGatewayModel::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'approved_by');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved' || $this->status === 'completed';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
