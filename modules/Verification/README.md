# Verification Module

## Purpose

Handles email and WhatsApp verification code generation, sending, and validation. Supports two purposes: `registration` and `reset`. Provides admin configuration for SMTP/WhatsApp settings.

## Key Entities / Relationships

| Table | Model | Key Columns | Notes |
|-------|-------|-------------|-------|
| `verification_codes` | `VerificationCodeModel` | `user_id`, `code` (6-digit), `type` (email/whatsapp), `purpose` (registration/reset), `expires_at`, `is_used` | `user` → `UserModel` |
| `verification_settings` | `VerificationSettingModel` | `email_enabled`, `whatsapp_enabled`, `smtp_host/port/username/password/from_address/from_name`, `whatsapp_api_key`, `whatsapp_phone_id`, `code_expiry_minutes`, `max_attempts` | Singleton config |

Key model methods:
- `VerificationCodeModel::isExpired()` — checks if `expires_at` is past
- `VerificationCodeModel::isValid()` — not used AND not expired

## API Endpoints

No dedicated REST API. Filament-based operations:
- **Admin**: `VerificationCodeResource` (full CRUD), `VerificationSettings` page (singleton settings form)
- **Client**: `VerificationPage` — send and verify codes

## Events / Listeners

None.

## Integration with the Rest of the System

- **User module**: Verification updates `UserModel.email_verified` and `UserModel.phone_verified` flags; FKs to `users`
- **Auth module**: Registration and password reset flows call into `VerificationRepository` for code generation/validation
- Email sending and WhatsApp API calls are **not implemented** — the repository has TODO comments and stubbed methods

## Config / Env Vars

No dedicated env vars. All configuration is stored in the `verification_settings` database table and managed through the admin UI.

## Known Quirks / Dependencies

- **Email/WhatsApp sending is not implemented** — `sendEmailVerification()` and `sendWhatsAppVerification()` generate and store codes but the actual Mail/WhatsApp send calls are commented out as TODOs
- `testEmailSettings()` and `testWhatsAppSettings()` always return success regardless of actual configuration
- `generateAndStoreCode()` deletes all previous unused codes of the same type for the same user (single active code per type)
- Codes are 6-digit random integers cast to strings
- `max_attempts` field exists in the model/migration but is never enforced in the repository
- The `VerificationSettings` page uses a Blade view (`verification::filament.pages.verification-settings`) — not a Filament resource form
