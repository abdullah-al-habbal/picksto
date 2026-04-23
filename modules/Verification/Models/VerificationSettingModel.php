<?php

declare(strict_types=1);

namespace Modules\Verification\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property bool $email_enabled
 * @property bool $whatsapp_enabled
 * @property string|null $smtp_host
 * @property int|null $smtp_port
 * @property string|null $smtp_username
 * @property string|null $smtp_password
 * @property string|null $smtp_from_address
 * @property string|null $smtp_from_name
 * @property string|null $whatsapp_api_key
 * @property string|null $whatsapp_phone_id
 * @property int $code_expiry_minutes
 * @property int $max_attempts
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class VerificationSettingModel extends Model
{
    protected $table = 'verification_settings';

    protected $fillable = [
        'email_enabled',
        'whatsapp_enabled',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_from_address',
        'smtp_from_name',
        'whatsapp_api_key',
        'whatsapp_phone_id',
        'code_expiry_minutes',
        'max_attempts',
    ];

    protected function casts(): array
    {
        return [
            'email_enabled' => 'boolean',
            'whatsapp_enabled' => 'boolean',
            'smtp_port' => 'integer',
            'code_expiry_minutes' => 'integer',
            'max_attempts' => 'integer',
        ];
    }
}
