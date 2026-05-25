# Subscription Module

## Purpose

Manages user subscriptions to packages. Handles lifecycle (pending → active → expired/cancelled), download counters, scheduled expiry, and daily counter resets.

## Key Entities / Relationships

| Table | Model | Key Columns |
|-------|-------|-------------|
| `subscriptions` | `SubscriptionModel` | `user_id`, `package_id`, `status` (pending/active/expired/cancelled), `start_date`, `end_date`, `downloads_today`, `downloads_month`, `last_download_date`, `payment_method`, `transaction_id` |

Relations:
- `user` → `UserModel`
- `package` → `PackageModel`

Key scopes/methods:
- `scopeActive()` — status=active AND end_date >= now
- `scopeByUser()` — filter by user_id
- `canDownload()` — checks status + daily/monthly limits against package
- `incrementDownloadCounters()` — increments both today/month counters and updates last_download_date
- `resetDailyCounter()` — sets downloads_today to 0
- Accessors: `remaining_downloads_today`, `remaining_downloads_month`

## API Endpoints

No dedicated REST API. All interactions go through Filament:
- **Admin**: `SubscriptionResource` (full CRUD) + `SubscriptionsRelationManager` (used by User/Package resources)
- **Client**: `SubscriptionPage` (list own subscriptions)
- **Purchase**: `PurchasePackageRequest` validates package selection; `SubscriptionRepository::purchasePackage()` creates active subscription directly

## Events / Listeners

None explicitly dispatched, but these queued jobs exist:

| Job | Command | Schedule | Purpose |
|-----|---------|----------|---------|
| `ExpireOverdueSubscriptionsJob` | `subscription:expire-overdue` | Recommended daily | Sets expired status on overdue active subscriptions |
| `ResetDailyDownloadCountersJob` | `subscription:reset-daily-counters` | Recommended daily at midnight | Resets `downloads_today` to 0 for all active subs |
| `SendSubscriptionExpiryNotificationJob` | — | Manual/triggered | Placeholder — fetches subscription/user but no notification logic yet |

Commands accept `--sync` flag to run synchronously instead of dispatching to the queue.

## Integration with the Rest of the System

- **Package module**: Subscriptions FK to `packages`; uses `PackageModel.duration_days`, `daily_limit`, `monthly_limit`, `allowed_sites`
- **User module**: `UserModel` has `subscriptions()` HasMany relationship
- **Download module**: Checks `SubscriptionRepository::canUserDownload()` before allowing downloads
- **Payment/SubscriptionRequest modules**: Approval of subscription requests creates subscriptions via `SubscriptionRepository::create()`
- **Analytics module**: `SubscriptionRepository::getRevenueByDay()` and `getPackagePerformance()` feed analytics widgets
- Panel auto-discovers `Filament/Admin/Resources/RelationManagers/SubscriptionsRelationManager`

## Config / Env Vars

No dedicated env vars.

## Known Quirks / Dependencies

- `purchasePackage()` uses status 'active' by default (not 'pending') — payment gateways may need to override this
- `SendSubscriptionExpiryNotificationJob` has no actual notification implementation (placeholder)
- `SubscriptionService::activateManualSubscription()` duplicates some `SubscriptionRepository` logic
- `SubscriptionRepository::getPackagePerformance()` hardcodes Arabic column name (`name->ar`) for grouping
- `getRevenueByDay()`/`getTotalActiveRevenue()` join on `packages.price` — assumes package price hasn't changed
- Daily counter reset and expiry expiration should be scheduled via cron but are not automatically registered
