# 🔍 Admin Routes Audit & Tracking Table

**Goal:** Inventory every admin-facing route across all modules to migrate to Filament and remove the old API endpoints.

| Module           | Old Route Prefix               | Middleware                    | Filament Target                            | Status     |
| ---------------- | ------------------------------ | ----------------------------- | ------------------------------------------ | ---------- |
| **Verification** | `/admin/verification-settings` | `auth, role:admin`            | `VerificationCodeResource` & Settings      | ⬜ Pending |
| **User**         | `/admin/users`                 | `auth, role:admin,supervisor` | `UserResource`                             | ⬜ Pending |
| **Ticket**       | `/admin/tickets`               | `auth, role:admin`            | `TicketResource`                           | ⬜ Pending |
| **Subscription** | `/admin/subscription`          | `auth, role:admin`            | `SubscriptionResource`                     | ⬜ Pending |
| **Referral**     | `/admin/referral`              | `auth, role:admin`            | `ReferralResource`                         | ⬜ Pending |
| **Product**      | `/admin/products`              | `auth, role:admin`            | `ProductResource`                          | ⬜ Pending |
| **Payment**      | `/admin/payment`               | `auth, role:admin`            | `PaymentGatewayResource`                   | ⬜ Pending |
| **Package**      | `/admin/packages`              | `auth, role:admin`            | `PackageResource`                          | ⬜ Pending |
| **LemonSqueezy** | `/admin/lemonsqueezy`          | `auth, role:admin`            | `LemonSqueezyCustomerResource` & `Product` | ⬜ Pending |
| **Download**     | `/admin/downloads`             | `auth, role:admin`            | `DownloadResource`                         | ⬜ Pending |
| **Analytics**    | `/admin/analytics`             | `auth, role:admin`            | `Dashboard Widgets`                        | ⬜ Pending |
| **TestProvider** | `/admin/test-provider`         | `auth, role:admin`            | `Custom Pages / Actions`                   | ⬜ Pending |

## The "Migrate → Remove → Commit" Loop

We will go through each module, verify the Filament equivalent is fully functional, remove the old routes, and commit the cleanup.

_Generated: April 28, 2026_
