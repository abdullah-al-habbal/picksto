# SubscriptionRequest Module

## Purpose

Manages subscription upgrade/purchase requests that require admin approval. Users submit requests for a package, optionally selecting a payment gateway, and an admin approves or rejects them.

## Key Entities / Relationships

| Table | Model | Key Columns |
|-------|-------|-------------|
| `subscription_requests` | `SubscriptionRequestModel` | `user_id`, `package_id`, `gateway_id` (nullable), `status` (pending/approved/rejected/completed), `transaction_id`, `amount`, `currency` (default SAR), `admin_notes`, `user_notes`, `approved_at`, `approved_by` |

Relations:
- `user` → `UserModel`
- `package` → `PackageModel`
- `gateway` → `PaymentGatewayModel` (nullable)
- `approver` → `UserModel` (nullable, via `approved_by`)

Scopes: `pending()`, `byUser()`, `byStatus()`

## API Endpoints

No dedicated REST API. All operations via Filament:
- **Admin**: `SubscriptionRequestResource` (full CRUD) with custom `SubscriptionRequestActions`:
  - `approve()` — marks completed, creates active subscription via PaymentRepository
  - `reject()` — marks rejected
- **Client**: `MySubscriptionRequestResource` (list/view only, scoped to auth user)

## Events / Listeners

None.

## Integration with the Rest of the System

- **Package module**: Requests FK to packages for pricing and duration
- **Payment module**: `PaymentRepository::approveRequest()` creates the actual subscription via `SubscriptionRepository::create()` after approval
- **Payment Gateway module**: Optional FK to `payment_gateways` for gateway selection
- **Subscription module**: Approved requests create active subscription records automatically
- **User module**: Tracks which admin approved the request

Flow: Client creates request → Admin approves → `PaymentRepository::approveRequest()` sets status to "completed" and creates a Subscription with status "active".

## Config / Env Vars

No dedicated env vars.

## Known Quirks / Dependencies

- Strong dependency on `PaymentRepository` (in Payment module) which orchestrates the approve/reject flow — the actions never call `SubscriptionRequestRepository` directly for status changes
- `SubscriptionRequestRepository::updateStatus()` sets `approved_at` to now() even for rejections (field name mismatch with semantics)
- Client resource is read-only (no create/edit); request creation may happen via the Payment module's checkout flow
- Default currency is hardcoded as `SAR`
