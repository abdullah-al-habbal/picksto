<?php

// Currency/Models/CurrencySettingModel.php

declare(strict_types=1);

namespace Modules\Currency\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property string $symbol
 * @property string $name
 * @property int $decimal_places
 * @property string $decimal_separator
 * @property string $thousands_separator
 * @property bool $symbol_position
 * @property bool $space_between
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class CurrencySettingModel extends Model
{
    protected $table = 'currency_settings';

    protected $fillable = [
        'code',
        'symbol',
        'name',
        'decimal_places',
        'decimal_separator',
        'thousands_separator',
        'symbol_position',
        'space_between',
    ];

    protected $casts = [
        'decimal_places' => 'integer',
        'symbol_position' => 'boolean',
        'space_between' => 'boolean',
    ];

    public function format(float $amount): string
    {
        $formatted = number_format(
            $amount,
            $this->decimal_places,
            $this->decimal_separator,
            $this->thousands_separator
        );

        $space = $this->space_between ? ' ' : '';

        return $this->symbol_position
            ? "{$this->symbol}{$space}{$formatted}"
            : "{$formatted}{$space}{$this->symbol}";
    }
}
