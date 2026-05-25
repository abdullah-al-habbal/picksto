# Referral Module

## Purpose

Manages the referral program enabling users to invite others and earn rewards. Provides both admin configuration and client-facing referral tracking.

## Key Entities / Relationships

| Table | Model | Key Columns | Relations |
|-------|-------|-------------|-----------|
| `referral_settings` | `ReferralSettingModel` | `is_enabled`, `referrals_required`, `reward_type`, `reward_duration`, `reward_expiry_days`, `welcome_message`, `success_message` | Singleton config (first/only row) |
| `referrals` | `ReferralModel` | `referrer_id`, `referred_id`, `registered_at` | `referrer` → `UserModel`, `referred` → `UserModel` |
| `referral_rewards` | `ReferralRewardModel` | `user_id`, `status` (pending/claimed/expired), `earned_at`, `expires_at`, `claimed_at` | `user` → `UserModel` |

- `referrer_id` + `referred_id` unique constraint prevents duplicate referrals
- `reward_type` supports: `subscription`, `days`, `fixed_amount`
- `UserModel.referral_code` (6-char uppercase string) links users as referrers
- `UserModel.referred_by` FK to users table (optional)

## API Endpoints

No dedicated REST API. The module uses Filament actions for all operations:
- **Client**: Claim reward action on ReferralPage
- **Admin**: Settings page form submission

## Events / Listeners

None currently defined. Business logic is called synchronously in the repository.

## Integration with the Rest of the System

- **User module**: `UserModel.referral_code` and `UserModel.referred_by` are the core link fields
- **Subscription module**: Reward claiming is expected to grant subscription days (logic stubbed in `ReferralRepository::claimReward()`)
- **LemonSqueezy module**: Not integrated yet (reward payout is placeholder)
- Panel providers auto-discover `Filament/Admin/` and `Filament/Client/` resources/pages

## Config / Env Vars

No dedicated env vars. Settings are stored in the `referral_settings` database table and managed through the admin UI.

## Known Quirks / Dependencies

- `reward_type` logic is not fully implemented — the `claimReward()` method has a placeholder comment about applying the actual reward (e.g., adding subscription days)
- `ReferralRepository::getAdminStatistics()` returns raw stats but is not connected to any analytics widget
- Referral link generation is handled by the Auth/registration module reading `UserModel.referral_code`
- The seeder (`ReferralSeeder`) seeds default settings if none exist
