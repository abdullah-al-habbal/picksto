# Package Module

## Purpose
Defines subscription packages (plans) with tiered limits, pricing, and site access controls. Translatable name/description fields.

## Key Entities / Relationships

### `PackageModel` (table: `packages`)
| Field | Type | Description |
|-------|------|-------------|
| `name` | json (translatable) | Package name |
| `description` | json (translatable) | Package description |
| `price` | decimal(10,2) | Price amount |
| `currency` | string | Currency code |
| `daily_limit` | integer | Max downloads per day |
| `monthly_limit` | integer | Max downloads per month |
| `allowed_sites` | json | Array of allowed site sources (or `["All"]`) |
| `duration_days` | integer | Subscription duration in days |
| `is_active` | boolean | Whether package is available |

### Relationships
- `HasMany` → `SubscriptionModel` (subscriptions)
- `MorphMany` → `DownloadModel` (via `downloadable` morph map: `package`)

### Scopes
- `scopeActive()` — `is_active = true`
- `scopeByPriceRange(min, max)`
- `scopeSupportsSite(site)` — checks `allowed_sites` JSON contains the site or `"All"`

### Translatable
- Uses `spatie/laravel-translatable` for `name` and `description`.
- `lara-zeus/spatie-translatable` Filament plugin for admin CRUD translatable fields.

## API Endpoints
None (no routes file).

## Admin Filament

| Resource | Pages |
|----------|-------|
| `PackageResource` | List, Create, View, Edit |
| Trait: `Translatable` | Translatable form/infolist fields |
| Navigation group: Subscriptions | Icon: `heroicon-o-rectangle-stack` |

### Relation Managers
- `SubscriptionsRelationManager` — shows subscriptions for a package inside the package view/edit page.

## Client Filament

| Page | Description |
|------|-------------|
| `PlansPage` | Lists active packages with subscription request modal |
| Navigation group: Subscriptions | Sort order: 2 |

- Uses `RequestSubscriptionForm` from the Payment module for the request modal.
- After request submission, notification includes link to `MySubscriptionRequestResource`.

## Events / Listeners
None defined within the module.

## Integration with Rest of System
- **Subscription module:** `PackageModel::subscriptions()` relation links to `SubscriptionModel`.
- **Download module:** Package is a `downloadable` morph target for download records.
- **Payment module:** `PlansPage` consumes `RequestSubscriptionForm` schema and `PaymentRepository::requestSubscription()`.
- **Analytics module:** `PackagePerformanceWidget` shows subscription distribution by package.
- **Currency module:** Package price may be formatted using global currency settings.

## Config / Env Vars
None.

## Known Quirks / Dependencies
- Requires `spatie/laravel-translatable` and `lara-zeus/spatie-translatable` for translatable field support.
- `allowed_sites` JSON column: store an array of site names the package supports. `"All"` means all sites are accessible.
- `PackageRepository::getActivePackages()` orders by `price ASC`.
- `PackageRepository::getAllWithPagination()` supports searching translatable name/description fields directly with JSON path syntax.
- `PackageRepository::existsByNameAr()` checks uniqueness by Arabic name specifically.
- `getNavigationBadge()` is cached for 5 minutes.
- Table displays `name`, `price` (USD money format), `duration` (with "days" suffix), and `downloads_per_day`.
- Deleting a package will cascade — but `allowed_sites` uses `null` filtering via `array_filter` in `update()`.
