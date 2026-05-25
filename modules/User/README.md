# User Module

## Purpose

Core user management — the primary authentication model for the application. Handles user accounts, roles, bans, profiles, avatars, referral relationships, and per-user settings (language, currency, notifications).

## Key Entities / Relationships

| Table | Model | Key Columns | Relations |
|-------|-------|-------------|-----------|
| `users` | `UserModel` | `name`, `email`, `password`, `phone`, `role` (user/admin/supervisor), `is_banned`, `avatar`, `referral_code` (unique), `referred_by`, `profession`, `company_size`, `last_login_at`, soft deletes | `setting` (HasOne), `subscriptions` (HasMany), `referrals` (HasMany via referred_by), `referrer` (BelongsTo via referred_by) |
| `user_settings` | `UserSettingModel` | `user_id` (unique), `language_id`, `currency_id`, `notify_email_enabled`, `notify_whatsapp_enabled` | `user` (BelongsTo), `language` (BelongsTo), `currency` (BelongsTo) |

`UserModel` implements:
- `FilamentUser` — `canAccessPanel()` controls panel access: admin/supervisor → `/admin`, user → `/client`
- `HasAvatar` — `getFilamentAvatarUrl()` returns avatar URL
- `HasApiTokens` — Laravel Sanctum API tokens
- `SoftDeletes` — soft deletable
- `Notifiable` — Laravel notifications

## API Endpoints

No dedicated REST API. Filament-based operations:
- **Admin**: `UserResource` (full CRUD) with `UserActions`:
  - `changeRole()` — visible to admin only, sets user/supervisor/admin
  - `toggleBan()` — ban/unban user
  - `activatePackage()` — admin-only, creates manual subscription via SubscriptionService
  - `EditProfile` page — admin edits own profile
- **Client**: `ProfilePage` — user edits own profile (name, email, phone, profession, company_size)

## Middleware

- `CheckUserBanMiddleware` — applied to both admin and client panels. Logs out banned users, invalidates session, redirects to login with error message.

## Events / Listeners

None explicitly dispatched in this module.

## Integration with the Rest of the System

- **Almost every module** FKs to `users` table (subscriptions, tickets, referrals, verification codes, subscription requests, etc.)
- **Subscription module**: `UserModel` has `subscriptions()` HasMany; admin can activate packages on behalf of users
- **Referral module**: `referral_code` and `referred_by` on users are the entry points for the referral system
- **Settings module**: User notification preferences stored in `user_settings` are managed by SettingsRepository
- **Upload module**: Avatar uploads update `users.avatar` via UploadRepository
- **Language/Currency modules**: `user_settings` FK to languages and currency_settings
- **Auth module**: Registration creates users with generated referral_code; handles referred_by logic
- Panel access logic in `canAccessPanel()` controls all Filament authorization

## Config / Env Vars

| Key | Required | Description |
|-----|----------|-------------|
| `AUTH_MODEL` | Yes | Must be `Modules\User\Models\UserModel` |
| `AUTH_GUARD` | Yes | Must be `web` |

## Known Quirks / Dependencies

- `UserRepository::create()` generates a unique 6-char uppercase referral code using `Str::random(6)` — collisions are checked in a loop
- `UserRepository::activatePackage()` delegates to `SubscriptionService` which is in a separate module — circular-ish dependency via constructor injection
- `UserRepository::getAllWithPagination()` uses a simple LIKE search across name/email/phone — no advanced search or filtering
- `CheckUserBanMiddleware` uses `Filament::getCurrentPanel()` to find the login URL — will fail outside Filament context (e.g., API routes)
- `UserModel::getFilamentAvatarUrl()` prepends `asset('storage/')` but the Upload module stores avatars already prefixed with `/storage/` — likely double-prefixing
- The seeder creates a default admin user (`admin@picksto.com`)
