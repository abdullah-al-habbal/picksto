# 🚀 Phase 2: Admin Route Cleanup → Client Filament Panel
**Status:** In Progress | **Started:** April 28, 2026

---

## 📊 Admin Routes Migration Tracking

| # | Module           | Old Route Prefix               | Filament Resource         | Routes | Status | Commit Hash |
|---|------------------|--------------------------------|---------------------------|--------|--------|-------------|
| 1 | **User**         | `/admin/users`                 | `UserResource`            | 5      | ✅ Migrated |      |
| 2 | **Ticket**       | `/admin/tickets`               | `TicketResource`          | 4      | ⬜ Pending |      |
| 3 | **Download**     | `/admin/downloads`             | `DownloadResource`        | 3      | ⬜ Pending |      |
| 4 | **Payment**      | `/admin/payment`               | `PaymentGatewayResource`  | 7      | ⬜ Pending |      |
| 5 | **Subscription** | `/admin/subscription`          | `SubscriptionResource`    | 1      | ⬜ Pending |      |
| 6 | **Product**      | `/admin/products`              | `ProductResource`         | 3      | ⬜ Pending |      |
| 7 | **Package**      | `/admin/packages`              | `PackageResource`         | 3      | ⬜ Pending |      |
| 8 | **Referral**     | `/admin/referral`              | `ReferralResource`        | 5      | ⬜ Pending |      |
| 9 | **Analytics**    | `/admin/analytics`             | `Dashboard Widgets`       | 3      | ⬜ Pending |      |
| 10| **LemonSqueezy** | `/admin/lemonsqueezy`          | `LemonSqueezyResource`    | 3      | ⬜ Pending |      |
| 11| **TestProvider** | `/admin/test-provider`         | `Custom Pages`            | 2      | ⬜ Pending |      |
| 12| **Verification** | `/admin/verification-settings` | Settings Page             | 0      | ✅ N/A - No admin routes |      |

---

## 🔄 Batch Migration Workflow

### Batch 1: User Module → Remove 5 Routes
**Routes to remove:**
- `GET /admin/users`
- `GET /admin/users/{user}`
- `PUT /admin/users/{user}/role`
- `POST /admin/users/{user}/package`
- `PUT /admin/users/{user}/ban`

**Actions to remove from code:**
- [x] `GetUserDetailsAction`
- [x] `ChangeUserRoleAction`
- [x] `ActivateUserPackageAction`
- [x] `ToggleUserBanAction`

**Checklist:**
- [ ] Verify UserResource exists in Filament & all features working
- [ ] Test each UserResource action in browser: `/admin/filament/app/users`
- [ ] Remove route group from `modules/User/Routes/web.php`
- [ ] Delete action classes if not used elsewhere
- [ ] Run `php artisan route:clear && php artisan config:clear`
- [ ] Verify routes removed: `php artisan route:list | grep admin/users`
- [ ] Commit: `fix: remove deprecated admin user routes -> moved to Filament UserResource`

---

## 📋 Cycle Progress Notes

### User Module (Batch 1)
- **Status:** ✅ Completed
- **Date Started:** April 28, 2026
- **Date Completed:** April 28, 2026
- **Routes Removed:** 5 (GET/PUT/POST /admin/users/*)
- **Actions Deleted:** GetUserDetailsAction, ChangeUserRoleAction, ActivateUserPackageAction, ToggleUserBanAction
- **Notes:** Filament UserResource fully functional; all admin actions removed successfully

---

## ✅ Completed Modules (1/12)
1. User Module ✅

---

## 🔜 Next Steps
1. Start **Batch 1: User Module** migration
2. Follow "Migrate → Remove → Commit" loop exactly
3. Update progress here after each cycle
4. Once all admin routes cleaned, build client Filament panel

_Last Updated: April 28, 2026_
