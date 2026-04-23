<?php

// Ticket/Models/TicketModel.php

declare(strict_types=1);

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\Ticket\Database\Factories\TicketModelFactory;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $message
 * @property 'open'|'pending'|'closed'|'resolved' $status
 * @property 'low'|'medium'|'high' $priority
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read UserModel $user
 * @property-read HasMany<TicketReplyModel, int> $replies
 */
final class TicketModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'status',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'is_admin' => 'boolean',
        ];
    }

    protected static function newFactory(): TicketModelFactory
    {
        return TicketModelFactory::new();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TicketReplyModel::class);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'open');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }
}
