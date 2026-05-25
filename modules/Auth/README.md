# Auth Module

## Purpose
Handles user authentication: login, registration, password reset, and session management. Works with the `web` guard (session-based) and integrates tightly with the User module.

## Key Entities / Relationships
- **No dedicated model** — operates on `Modules\User\Models\UserModel`.
- **Tables:** `sessions` (user sessions), `password_reset_tokens` (password reset flow).
- **Repository:** `AuthRepository` — `register()`, `findByEmail()`, `findByIdWithRelations()`, `emailExists()`, generates unique referral codes.
- **Presenter:** `AuthPresenter` — serializes `UserModel` for API responses (includes subscription status check).

## HTTP Requests (FormRequest)

| Request | Purpose | Validation |
|---------|---------|------------|
| `LoginRequest` | Authenticate user | email (required, email), password (required) |
| `RegisterRequest` | Create account | fullName, email (unique:users), password (8+ chars, mixed case, letters+numbers, confirmed), phone, profession, companySize, referredBy |
| `ForgotPasswordRequest` | Send reset link | email (required, email) |
| `ResetPasswordRequest` | Complete reset | token (required), email (required, email), password (8+ chars, mixed case, confirmed) |

All requests lowercase+trim the email before validation.

## API Endpoints
None as dedicated REST routes. Auth actions are invoked directly within Filament panels or via Laravel's built-in auth controllers. The module provides the request classes and repository logic consumed by those entry points.

## Events / Listeners
None defined within the module.

## Integration with Rest of System
- Strong dependency on `Modules\User\Models\UserModel` for all operations.
- Registration creates users with `referral_code`, optional `referred_by`, `profession`, `company_size`.
- `AUTH_GUARD=web` and `AUTH_MODEL=Modules\User\Models\UserModel` must be set in `.env`.
- Session table migration creates the standard Laravel sessions schema (driver must be `database`).

## Config / Env Vars

| Key | Default | Description |
|-----|---------|-------------|
| `AUTH_GUARD` | `web` | Auth guard used |
| `AUTH_MODEL` | — | User model FQCN |
| `AUTH_PASSWORD_BROKER` | `users` | Password reset broker |
| `AUTH_PASSWORD_RESET_TOKEN_TABLE` | `password_reset_tokens` | Reset tokens table |
| `AUTH_PASSWORD_TIMEOUT` | `10800` | Reset token expiry (seconds) |

## Known Quirks / Dependencies
- No Filament resources or pages — auth is handled by Laravel's built-in scaffolding or custom controllers outside this module.
- Referral code generation uses a 6-character uppercase random string with uniqueness check (retry loop).
- `findByIdWithRelations()` eager-loads `referrals`, `referrer`, and latest `subscriptions` — relevant for profile display.
- The `AuthPresenter` checks for active subscriptions dynamically (inline query in `present()` method).
- Password rules enforce minimum 8 characters with mixed case, letters, and numbers.
- `RegisterRequest` email uniqueness is checked against the `users` table.
