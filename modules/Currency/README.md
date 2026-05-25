# Currency Module

## Purpose
Manages global currency display settings (formatting, symbol) and per-user currency preference. Provides a single-row configuration table.

## Key Entities / Relationships

### `CurrencySettingModel` (table: `currency_settings`)
| Field | Type | Default | Description |
|-------|------|---------|-------------|
| `code` | string(3) | `SAR` | ISO 4217 code |
| `symbol` | string | `ر.س` | Currency symbol |
| `name` | string | `Saudi Riyal` | Display name |
| `decimal_places` | integer | `2` | Decimal precision |
| `decimal_separator` | string | `.` | Decimal point char |
| `thousands_separator` | string | `,` | Thousands separator |
| `symbol_position` | boolean | `true` | `true` = before, `false` = after |
| `space_between` | boolean | `false` | Space between symbol and amount |

### Relationships
- Referenced by `UserSettingModel` via `currency_id` foreign key.

## API Endpoints
- `UpdateCurrencySettingsAction` — POST endpoint for updating global settings (invokable controller).

## Admin Filament

| Resource | Pages |
|----------|-------|
| `CurrencySettingResource` | List, Create, View, Edit |
| Navigation group: Settings | Icon: `heroicon-o-currency-dollar` |

## Client Filament

| Page | Description |
|------|-------------|
| `CurrencyPage` | User currency preference selection form |
| Navigation group: Account | Sort order: 11 |

## Events / Listeners
None.

## Integration with Rest of System
- **User settings:** `CurrencyRepository::updateUserCurrencySetting()` creates/updates a `UserSettingModel` record with the selected `currency_id`.
- **Formatting helper:** `CurrencySettingModel::format(float $amount): string` returns a formatted string using the stored configuration.
- `CurrencyRepository::format()` provides a convenience wrapper for global formatting.
- Default seeded via `CurrencySeeder`: SAR (Saudi Riyal).

## Config / Env Vars
None.

## Known Quirks / Dependencies
- Single-row table design — only one currency setting configuration is expected (the global display format).
- When no settings row exists, `CurrencyRepository::format()` falls back to `number_format($amount, 2)`.
- `symbol_position = true` means symbol before amount (e.g., `$10.00`), `false` means after (e.g., `10.00 $`).
- `space_between` inserts a space between symbol and amount regardless of position.
- The `UpdateCurrencySettingsAction` uses `DB::beginTransaction`/`commit`/`rollBack` for the update operation.
- Depends on `Modules\User\Models\UserSettingModel` for per-user currency preference storage.
