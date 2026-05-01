<?php

// modules/User/Models/UserModel.php

declare(strict_types=1);

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Modules\Subscription\Models\SubscriptionModel;
use Modules\User\Database\Factories\UserModelFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $phone
 * @property bool $phone_verified
 * @property bool $email_verified
 * @property 'user'|'admin'|'supervisor' $role
 * @property bool $is_banned
 * @property string|null $avatar
 * @property string $referral_code
 * @property int|null $referred_by
 * @property string|null $profession
 * @property string|null $company_size
 * @property Carbon|null $last_login_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read HasMany<UserModel, int> $referrals
 * @property-read BelongsTo<UserModel, int> $referrer
 * @property-read string|null $avatar_url
 */
final class UserModel extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'phone_verified',
        'email_verified',
        'role',
        'is_banned',
        'avatar',
        'referral_code',
        'referred_by',
        'profession',
        'company_size',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'phone_verified' => 'boolean',
            'email_verified' => 'boolean',
            'is_banned' => 'boolean',
            'settings' => 'array',
        ];
    }

    protected static function newFactory(): UserModelFactory
    {
        return UserModelFactory::new();
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(UserModel::class, 'referred_by');
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'referred_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_banned', false);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('email_verified', true);
    }

    public function scopeAdmins(Builder $query): Builder
    {
        return $query->whereIn('role', ['admin', 'supervisor']);
    }

    public function scopeWithReferralStats(Builder $query): Builder
    {
        return $query->withCount('referrals');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    public function isBanned(): bool
    {
        return $this->is_banned;
    }

    public function isVerified(): bool
    {
        return $this->email_verified && $this->phone_verified;
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar !== null ? url($this->avatar) : null;
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionModel::class, 'user_id');
    }

    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }
}
