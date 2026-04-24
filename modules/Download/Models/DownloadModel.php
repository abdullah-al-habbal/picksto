<?php

// modules/Download/Models/DownloadModel.php

declare(strict_types=1);

namespace Modules\Download\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Modules\Download\Database\Factories\DownloadModelFactory;
use Modules\User\Models\UserModel;

/**
 * @property int $id
 * @property int $user_id
 * @property string $original_url
 * @property string|null $file_name
 * @property string $site_source
 * @property 'pending'|'processing'|'completed'|'failed' $status
 * @property string|null $download_path
 * @property string|null $ip_address
 * @property string|null $error_message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read UserModel $user
 */
final class DownloadModel extends Model
{
    use HasFactory;

    protected $table = 'downloads';

    protected $fillable = [
        'user_id',
        'original_url',
        'file_name',
        'site_source',
        'status',
        'download_path',
        'ip_address',
        'error_message',
    ];

    protected static function newFactory(): DownloadModelFactory
    {
        return DownloadModelFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeBySiteSource($query, string $siteSource)
    {
        return $query->where('site_source', $siteSource);
    }
}
