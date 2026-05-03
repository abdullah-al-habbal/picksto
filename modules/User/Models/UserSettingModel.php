<?php
// modules/User/Models/UserSettingModel.php
declare(strict_types=1);

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Language\Models\LanguageModel;
use Modules\Currency\Models\CurrencySettingModel;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $language_id
 * @property int|null $currency_id
 * @property bool $notify_email_enabled
 * @property bool $notify_whatsapp_enabled
 */
final class UserSettingModel extends Model
{
    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'language_id',
        'currency_id',
        'notify_email_enabled',
        'notify_whatsapp_enabled',
    ];

    protected function casts(): array
    {
        return [
            'notify_email_enabled' => 'boolean',
            'notify_whatsapp_enabled' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(LanguageModel::class, 'language_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(CurrencySettingModel::class, 'currency_id');
    }
}
