<?php

// modules/User/Models/UserModel.php

declare(strict_types=1);

namespace Modules\User\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
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
final class UserModel extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => in_array($this->role, ['admin', 'supervisor']),
            'client' => $this->role === 'user',
            default => false,
        };
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }

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

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionModel::class, 'user_id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(self::class, 'referred_by');
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(self::class, 'referred_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_banned', false);
    }

    public function scopeByRole(Builder $query, string $role): Builder
    {
        return $query->where('role', $role);
    }
}
