# Picksto Filament Resources Reference

**18 Resources across 2 panels (Admin + Client)**

---

## Admin Panel (`/admin`)

### Settings
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `SettingResource` | `SettingModel` | Settings | `key_name`, `value`, `group`, `description` | `key_name`, `value`, `group`, `created_at` |
| `CurrencySettingResource` | `CurrencySettingModel` | Settings | `code`, `symbol`, `name`, `decimal_places`, `decimal_separator`, `thousands_separator`, `symbol_position`, `space_between` | `code`, `symbol`, `name`, `created_at` |
| `PaymentGatewayResource` | `PaymentGatewayModel` | Settings | `name`, `type`, `is_active`, `description`, `config` | `name`, `type`, `is_active`, `created_at` |
| `LanguageResource` | `LanguageModel` | Settings | `name`, `code`, `is_active`, `is_default`, `is_rtl` | `name`, `code`, `is_active`, `is_default`, `is_rtl` |
| `VerificationCodeResource` | `VerificationCodeModel` | Settings | `user_id`, `type`, `code`, `purpose`, `expires_at`, `is_used` | `user.name`, `type`, `code`, `purpose`, `expires_at`, `is_used`, `created_at` |

### User Management
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `UserResource` | `UserModel` | User Management | `name`, `email`, `phone`, `role`, `avatar`, `profession`, `company_size`, `password` | `name`, `email`, `role`, `phone`, `is_banned`, `created_at`, `last_login_at` |
| Custom actions: `change_role`, `toggle_ban`, `activate_package` | | | | |

### Sales
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `SubscriptionResource` | `SubscriptionModel` | Sales | `user_id`, `package_id`, `status`, `start_date`, `end_date`, `downloads_today`, `downloads_month`, `payment_method`, `transaction_id` | `id`, `user.name`, `package.name`, `status`, `start_date`, `end_date`, `downloads_today`, `created_at` |
| `SubscriptionRequestResource` | `SubscriptionRequestModel` | Sales | `user_id`, `package_id`, `gateway_id`, `amount`, `transaction_id`, `status`, `user_notes`, `admin_notes` | `id`, `user.name`, `package.name`, `amount`, `status`, `created_at` |
| `ProductResource` | `ProductModel` (Translatable) | Sales | `name`, `price`, `currency`, `image_url`, `sort_order`, `is_active`, `description` | `image_url`, `name`, `price`, `is_active`, `created_at` |
| `DownloadResource` | `DownloadModel` | Sales | `user_id`, `file_name`, `original_url`, `site_source`, `downloadable_type`, `downloadable_id`, `status`, `ip_address` | `user.name`, `file_name`, `site_source`, `downloadable.name`, `status`, `created_at` |

### Subscriptions
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `PackageResource` | `PackageModel` (Translatable) | Subscriptions | `name`, `description`, `price`, `currency`, `duration_days`, `daily_limit`, `monthly_limit`, `allowed_sites`, `is_active` | `name`, `price`, `duration_days`, `daily_limit`, `created_at` |

### Support
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `TicketResource` (Admin) | `TicketModel` | Support | `user_id`, `subject`, `status`, `priority`, `message` | `id`, `user.name`, `subject`, `status`, `priority`, `created_at` |
| Custom actions: `change_status`, `add_reply` | | | | |

### Referral
| Resource | Model | Nav Group | Form Fields | Table Columns |
|----------|-------|-----------|-------------|---------------|
| `ReferralResource` | `ReferralModel` | Referral | `referrer_id`, `referred_id`, `registered_at` | `referrer.name`, `referred.name`, `registered_at`, `created_at` |
| `ReferralRewardResource` | `ReferralRewardModel` | Referral | `user_id`, `status`, `earned_at`, `expires_at`, `claimed_at` | `user.name`, `status`, `earned_at`, `expires_at`, `claimed_at` |

### LemonSqueezy
| Resource | Model | Nav Group | Notes |
|----------|-------|-----------|-------|
| `LemonSqueezyProductResource` | null | LemonSqueezy | API-driven, read-only |
| `LemonSqueezyCustomerResource` | null | LemonSqueezy | API-driven, read-only |

---

## Client Panel (`/client`)

| Resource/Page | Model | Nav Group | Notes |
|---------------|-------|-----------|-------|
| `TicketResource` | `TicketModel` | Support | Scoped to `user_id = auth()->id()` |
| `MySubscriptionRequestResource` | `SubscriptionRequestModel` | Subscriptions | Read-only list scoped to current user |
| `PlansPage` | — | Subscriptions | Custom page |
| `ReferralPage` | — | Referral | Custom page with stats |
| `ProfilePage` | — | User | Custom page |
| `CurrencyPage` | — | Settings | Custom page (client currency selector) |

---

## Key Validation Rules

| Resource | Field | Rules |
|----------|-------|-------|
| All | `name` | `required`, `maxLength:255` |
| All | `code` | `required`, `length:3` or `length:6` |
| `VerificationCodeResource` | `code` | `required`, `length:6` |
| `PackageResource` | `price` | `required`, `numeric` |
| `ProductResource` | `price` | `required`, `numeric` |
| `DownloadResource` | `original_url` | `required`, `url`, `maxLength:2048` |
| `UserResource` | `email` | `email`, `required`, `unique(ignoreRecord)` |
| `TicketResource` | `message` | `required` (RichEditor/Textarea) |

## Morph Map

```
'product' → Modules\Product\Models\ProductModel
'package' → Modules\Package\Models\PackageModel
```
Used by `DownloadModel` for polymorphic `downloadable` relation.
