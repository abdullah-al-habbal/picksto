<?php

declare(strict_types=1);

namespace Modules\Referral\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Referral\Database\Factories\ReferralSettingModelFactory;

/**
 * @property int $id
 * @property bool $is_enabled
 * @property int $referrals_required
 * @property string $reward_type
 * @property int $reward_duration
 * @property int $reward_expiry_days
 * @property string|null $welcome_message
 * @property string|null $success_message
 */
final class ReferralSettingModel extends Model
{
    use HasFactory;

    protected $table = 'referral_settings';

    protected $fillable = [
        'is_enabled',
        'referrals_required',
        'reward_type',
        'reward_duration',
        'reward_expiry_days',
        'welcome_message',
        'success_message',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'referrals_required' => 'integer',
            'reward_duration' => 'integer',
            'reward_expiry_days' => 'integer',
        ];
    }

    protected static function newFactory(): ReferralSettingModelFactory
    {
        return ReferralSettingModelFactory::new();
    }
}
