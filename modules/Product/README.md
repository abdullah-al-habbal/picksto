# Product Module

## Purpose
Manages the product catalog — purchasable digital products with translatable names/descriptions, pricing, and display ordering.

## Key Entities / Relationships

### `ProductModel` (table: `products`)
| Field | Type | Description |
|-------|------|-------------|
| `name` | json (translatable) | Product name |
| `description` | json (translatable) | Product description |
| `price` | decimal(10,2) | Price amount |
| `currency` | string | Currency code |
| `image_url` | string|null | Product image URL |
| `is_active` | boolean | Whether product is visible in catalog |
| `sort_order` | integer | Display ordering (ascending) |

### Relationships
- `MorphMany` → `DownloadModel` (via `downloadable` morph map: `product`)
- Morph map registered in `DownloadServiceProvider`.

### Scopes
- `scopeActive()` — `is_active = true`, ordered by `sort_order`.

### Translatable
- Uses `spatie/laravel-translatable` for `name` and `description`.
- `lara-zeus/spatie-translatable` Filament plugin for admin CRUD translatable fields.

## API Endpoints
None (no routes file).

## Admin Filament

| Resource | Pages |
|----------|-------|
| `ProductResource` | List, Create, View, Edit |
| Trait: `Translatable` | Translatable form/infolist fields |
| Navigation group: Sales | Icon: `heroicon-o-shopping-bag` |

- Navigation badge (total count) cached for 5 minutes.

## Client Filament

| Page | Description |
|------|-------------|
| `CatalogPage` | Browse active products (read-only listing) |
| Navigation group: Content | Sort order: 3 |

- Products are loaded via `ProductRepository::getActiveProducts()` which uses `scopeActive()`.
- Custom Blade view at `product::filament.pages.catalog`.

## Events / Listeners
None.

## Integration with Rest of System
- **Download module:** Products are `downloadable` morph targets for download records.
- **Analytics module:** Product data may appear in analytics (indirectly via download associations).
- Product `image_url` can link to external storage or CDN.

## Config / Env Vars
None.

## Known Quirks / Dependencies
- Requires `spatie/laravel-translatable` and `lara-zeus/spatie-translatable` for translatable field support.
- Products and Packages share a similar translatable pattern but are distinct entities (products are one-time purchases, packages are subscription plans).
- The `show()` method is not defined in `CatalogPage` — it's a simple listing page with no detail view. Product details would need a separate page or modal.
- No cart, checkout, or purchase flow exists in this module — it's a catalog only. Purchase integration is expected to be handled separately.
- `ProductRepository` is minimal — no custom methods beyond what is auto-generated or simple queries.
- `sort_order` allows manual ordering in the admin panel; ascending order is used in the active scope.
