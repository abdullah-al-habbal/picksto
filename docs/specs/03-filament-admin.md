# Filament Admin Panel Spec

Path: `/admin` · Panel ID: `admin` · Provider: [`AdminPanelProvider.php`](../../app/Providers/Filament/AdminPanelProvider.php)

## Access

- Roles: `admin`, `supervisor` (`UserModel::canAccessPanel`)
- Profile: [`EditProfile`](../../modules/User/Filament/Admin/Pages/EditProfile.php)
- Dashboard widgets: Analytics (5 widgets, manually registered)

## Resources checklist

| Resource | Model | Relations / notes | Status |
|----------|-------|-------------------|--------|
| `UserResource` | `UserModel` | Subscriptions RM | Complete |
| `PackageResource` | `PackageModel` | Translatable, subscriptions RM, nav badge | Complete |
| `SubscriptionResource` | `SubscriptionModel` | — | Complete |
| `SubscriptionRequestResource` | `SubscriptionRequestModel` | Approve/reject actions, nav badge | Complete |
| `PaymentGatewayResource` | `PaymentGatewayModel` | — | Complete |
| `ProductResource` | `ProductModel` | Translatable | Complete |
| `DownloadResource` | `DownloadModel` | — | Complete |
| `TicketResource` | `TicketModel` | `RepliesRelationManager`, nav badge (open count) | Complete |
| `ReferralResource` | `ReferralModel` | — | Complete |
| `ReferralRewardResource` | `ReferralRewardModel` | List/view rewards | Complete |
| `SettingResource` | `SettingModel` | Global settings | Complete |
| `LanguageResource` | `LanguageModel` | — | Complete |
| `CurrencySettingResource` | `CurrencySettingModel` | — | Complete |
| `VerificationCodeResource` | `VerificationCodeModel` | — | Complete |
| `LemonSqueezyProductResource` | — (API) | `$model = null`, custom views | By design |
| `LemonSqueezyCustomerResource` | — (API) | `$model = null` | By design |

## Custom admin pages

| Page | Model / data | Pattern |
|------|--------------|---------|
| `VerificationSettings` | `VerificationSettingModel` singleton | Form page + blade |
| `ReferralSettings` | `ReferralSettingModel` singleton | Form page + blade |
| `EditProfile` | Current user | Filament `EditProfile` |

## Navigation groups

From `resources/lang/{locale}/dashboard.php` → `navigation.groups.*`:

- user_management, subscriptions, finance, content, configurations, sales, settings, referral, support, system

## Reference: PackageResource

- Translatable via `LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable`
- Schemas: `PackageForm`, `PackageInfolist`, `PackagesTable`
- Relation: `SubscriptionsRelationManager`
- Cached navigation badge (5 min)

## Reference: ReferralResource

- CRUD for referral links between users
- Complemented by `ReferralSettings` (program config) and `ReferralRewardResource` (reward lifecycle)

## Modules without admin Filament

| Module | Reason |
|--------|--------|
| Analytics | Widgets only |
| Auth | Panel login |
| Upload | API/storage helper |
| TestProvider | Dev utility |

## Admin acceptance criteria

- [x] All domain tables have CRUD or documented singleton/API exception
- [x] Referral settings + rewards manageable in admin
- [x] No orphan Filament PHP under `modules/Package/.../Users/`
- [x] Navigation badges cached where used (package, referral, subscription request, ticket)
