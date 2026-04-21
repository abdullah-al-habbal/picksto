<?php

declare(strict_types=1);

namespace Modules\Verification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\User\Models\UserModel;
use Modules\Verification\Database\Factories\VerificationCodeModelFactory;

/**
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property 'email'|'whatsapp' $type
 * @property 'registration'|'reset' $purpose
 * @property Carbon $expires_at
 * @property bool $is_used
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $user
 */
final class VerificationCodeModel extends Model
{
    protected $table = 'verification_codes';

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'purpose',
        'expires_at',
        'is_used',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'is_used' => 'boolean',
        ];
    }

    protected static function newFactory(): VerificationCodeModelFactory
    {
        return VerificationCodeModelFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isValid(): bool
    {
        return ! $this->is_used && ! $this->isExpired();
    }
}
