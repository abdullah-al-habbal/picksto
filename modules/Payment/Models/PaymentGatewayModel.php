<?php

// Payment/Models/PaymentGatewayModel.php

declare(strict_types=1);

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Payment\Database\Factories\PaymentGatewayModelFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $description
 * @property array|null $config
 * @property bool $is_active
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class PaymentGatewayModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'config',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'config' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function newFactory(): PaymentGatewayModelFactory
    {
        return PaymentGatewayModelFactory::new();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
