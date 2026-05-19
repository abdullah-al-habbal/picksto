# Picksto Laravel Service — Agent Guide

Modular Laravel 12 API + dual Filament v5 panels for the Picksto platform.

## Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 12, PHP 8.2+ |
| Admin UI | Filament 5 (`/admin`) |
| Client UI | Filament 5 (`/client`) |
| Auth | Session (`web` guard), Sanctum for API |
| i18n | Spatie Translatable + `lara-zeus/spatie-translatable` Filament plugin |
| Modules | PSR-4 `Modules\` → [`modules/`](modules/) |

## Quick start

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer dev:win   # Windows — serve, queue, vite
composer dev       # Unix — includes pail
```

Required `.env` keys for auth (see [`.env.example`](.env.example)):

- `AUTH_GUARD=web`
- `AUTH_MODEL=Modules\User\Models\UserModel`

Default seeded admin: `admin@picksto.com` (see [`modules/User/Database/Seeders/UserSeeder.php`](modules/User/Database/Seeders/UserSeeder.php)).

## Architecture

```
bootstrap/providers.php
  ├── Module *ServiceProvider (migrations, lang, views)
  ├── ApplicationServiceProvider
  ├── AdminPanelProvider  → discovers modules/*/Filament/Admin
  └── ClientPanelProvider → discovers modules/*/Filament/Client
```

Panel config: [`config/panels.php`](config/panels.php).

**Filament is never registered inside module service providers.** Discovery loops `modules/{Module}/Filament/{Admin|Client}/{Resources,Pages,Widgets}` in [`app/Providers/Filament/AdminPanelProvider.php`](app/Providers/Filament/AdminPanelProvider.php) and [`ClientPanelProvider.php`](app/Providers/Filament/ClientPanelProvider.php).

Analytics admin widgets are the exception — explicitly listed in `AdminPanelProvider`.

## Module layout

Each feature lives under `modules/{Name}/`:

| Path | Purpose |
|------|---------|
| `Providers/*ServiceProvider.php` | `loadMigrationsFrom`, `loadTranslationsFrom`, `loadViewsFrom` |
| `Models/` | Eloquent models (`*Model` suffix) |
| `Database/Migrations/` | Module-owned tables |
| `Repositories/` | Data access |
| `Filament/Admin/` or `Filament/Client/` | Resources, Pages, Widgets, `Schemas/`, `Tables/` |
| `lang/{en,ar}/` | `__('module::file.key')` |
| `Resources/views/` | Blade for custom Filament pages (`module::filament.pages.*`) |

Registered modules (18): Analytics, Auth, Currency, Download, Language, LemonSqueezy, Package, Payment, Product, Referral, Settings, Subscription, SubscriptionRequest, TestProvider, Ticket, Upload, User, Verification.

## Panels & auth

| Panel | ID | Path | Who can access |
|-------|-----|------|----------------|
| Admin | `admin` | `/admin` | `role` in `admin`, `supervisor` |
| Client | `client` | `/client` | `role` = `user` |

Logic: [`modules/User/Models/UserModel::canAccessPanel()`](modules/User/Models/UserModel.php).

Banned users are logged out via [`modules/User/Http/Middleware/CheckUserBanMiddleware.php`](modules/User/Http/Middleware/CheckUserBanMiddleware.php) on both panels.

## Filament conventions

- `declare(strict_types=1);` on all new PHP files.
- Forms/infolists in `Schemas/`, tables in `Tables/`.
- Translatable models: `use Translatable` on Resource + `SpatieTranslatablePlugin` on panel.
- **Client security:** scope queries with `getEloquentQuery()->where('user_id', auth()->id())` or equivalent.
- Navigation: `__('dashboard.navigation.groups.*')` and `__('module::file.labels.*')`.
- Reference implementations:
  - Admin CRUD: [`modules/Package/Filament/Admin/Resources/PackageResource.php`](modules/Package/Filament/Admin/Resources/PackageResource.php)
  - Client page + modal: [`modules/Package/Filament/Client/Pages/PlansPage.php`](modules/Package/Filament/Client/Pages/PlansPage.php)
  - Client stats/table: [`modules/Referral/Filament/Client/Pages/ReferralPage.php`](modules/Referral/Filament/Client/Pages/ReferralPage.php)

## Morph map (downloads)

Registered in [`modules/Download/Providers/DownloadServiceProvider.php`](modules/Download/Providers/DownloadServiceProvider.php):

- `product` → `ProductModel`
- `package` → `PackageModel`

## Do not

- Add Filament registration to module service providers (use panel providers).
- Build new features in [`resources/views/modules/`](resources/views/modules/) — legacy; use module Filament + `modules/*/Resources/views/`.
- Rely on `modules/*/Routes/web.php` unless the file exists (most `loadRoutes()` calls are no-ops).
- Use the orphan [`modules/Package/Filament/Admin/Resources/Users/`](modules/Package/Filament/Admin/Resources/Users/) stub (removed).

## Specs & backlog

| Document | Contents |
|----------|----------|
| [`docs/specs/01-architecture.md`](docs/specs/01-architecture.md) | Providers, discovery, module matrix |
| [`docs/specs/02-data-model.md`](docs/specs/02-data-model.md) | Tables, models, relations |
| [`docs/specs/03-filament-admin.md`](docs/specs/03-filament-admin.md) | Admin resources checklist |
| [`docs/specs/04-filament-client.md`](docs/specs/04-filament-client.md) | Client pages checklist |
| [`docs/specs/05-backlog.md`](docs/specs/05-backlog.md) | Prioritized remaining work |

Historical note: [`docs/report.md`](docs/report.md) (May 2026) is superseded by the specs above.
