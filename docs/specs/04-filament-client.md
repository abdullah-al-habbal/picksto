# Filament Client Panel Spec

Path: `/client` · Panel ID: `client` · Provider: [`ClientPanelProvider.php`](../../app/Providers/Filament/ClientPanelProvider.php)

## Access

- Role: `user` only
- Profile: [`ProfilePage`](../../modules/User/Filament/Client/Pages/ProfilePage.php) via `->profile()`
- Banned users: logged out by `CheckUserBanMiddleware`

## Pages & resources

| UI | Type | Scoping | View |
|----|------|---------|------|
| `ProfilePage` | Page (also panel profile) | `auth()->user()` | `user::filament.pages.profile` |
| `PlansPage` | Page | Active packages (public list) | `package::filament.pages.plans` |
| `SubscriptionPage` | Page + table | `user_id = auth()->id()` | `subscription::filament.pages.subscription` |
| `MySubscriptionRequestResource` | Resource | `getEloquentQuery()` scoped | Filament defaults |
| `DownloadsPage` | Page + table/form | `user_id = auth()->id()` | `download::filament.pages.downloads` |
| `CatalogPage` | Page | Active products (catalog) | `product::filament.pages.catalog` |
| `TicketResource` | Resource | `getEloquentQuery()` scoped | Filament defaults |
| `ReferralPage` | Page + table + action | `referrer_id = auth()->id()` | `referral::filament.pages.referral` |
| `SettingsPage` | Page | User settings via repo | `settings::filament.pages.settings` |
| `CurrencyPage` | Page | User currency via repo | `currency::filament.pages.currency` |
| `VerificationPage` | Page | `auth()->id()` via repo | `verification::filament.pages.verification` |

## Payment integration

No standalone client resource. Subscription upgrade flow:

1. `PlansPage` lists packages
2. Modal uses `Payment\Filament\Client\Schemas\RequestSubscriptionForm`
3. `PaymentRepository::requestSubscription()`

## Navigation groups (localized)

`dashboard.navigation.groups.*`:

| Key | Used by |
|-----|---------|
| `account` | Profile, Settings, Currency |
| `subscriptions` | Plans, Subscriptions, Subscription requests |
| `content` | Downloads, Product catalog |
| `growth` | Referral |
| `support` | Tickets |
| `billing` | Subscriptions (alias group) |

## Security rules

1. **Resources:** override `getEloquentQuery()` with `where('user_id', auth()->id())` (or `referrer_id` for referrals).
2. **Actions:** verify record ownership before update (e.g. reward claim).
3. **Never** expose admin-only fields (gateway secrets, other users' data).

## Reference: PlansPage

- `PackageRepository::getActivePackages()`
- `selectPackage()` opens modal
- `requestUpgrade()` → `PaymentRepository`

## Reference: ReferralPage

- Table query scoped to referrer
- `getReferralStats()` via `ReferralRepository`
- `claimRewardsAction()` with ownership check

## Gaps addressed

| Gap | Resolution |
|-----|------------|
| Hardcoded EN on Profile/Subscription nav | `__()` keys in module lang + dashboard groups |
| Missing `growth` / `account` lang keys | Added en/ar |
| No client profile route on panel | `ClientPanelProvider::profile(ProfilePage::class)` |
| No product catalog | `CatalogPage` + blade |
| Client ticket replies | Optional — not in P2 scope; admin has `RepliesRelationManager` |

## Client acceptance criteria

- [x] All primary user workflows available under `/client`
- [x] Queries scoped to authenticated client user
- [x] Navigation labels use `__()` in en + ar
- [x] Custom pages have module blade views
