# Payment Module

## Purpose
Manages payment gateway configurations and orchestrates the subscription request lifecycle (request → approve → reject). Gateways are stored in the database with JSON config; subscription requests are delegated to the SubscriptionRequest module.

## Key Entities / Relationships

### `PaymentGatewayModel` (table: `payment_gateways`)
| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Display name |
| `type` | string | Gateway type identifier |
| `description` | string|null | Human-readable description |
| `config` | json|null | Gateway-specific configuration (API keys, endpoints, etc.) |
| `is_active` | boolean | Whether gateway is currently accepting requests |
| `sort_order` | integer | Display/priority order |

### Scopes
- `scopeActive()` — `is_active = true`, ordered by `sort_order`.
- `scopeByType(type)` — filter by gateway type.

## API Endpoints
None (no routes file).

## Admin Filament

| Resource | Pages |
|----------|-------|
| `PaymentGatewayResource` | List, Create, View, Edit |
| Navigation group: Settings | Icon: `heroicon-o-credit-card` |

## Client Filament

| Schema | Description |
|--------|-------------|
| `RequestSubscriptionForm` | Select gateway + optional notes textarea |

- Used by `PlansPage` (Package module) inside a modal.
- Gateways are loaded dynamically via `PaymentRepository::getActiveGateways()`.

### `PaymentRepository`
| Method | Description |
|--------|-------------|
| `getActiveGateways()` | Delegates to `PaymentGatewayRepository` |
| `requestSubscription(userId, data)` | Creates a `SubscriptionRequestModel` via `SubscriptionRequestRepository` |
| `approveRequest(requestId, adminId)` | Updates request to `completed`, creates an active `SubscriptionModel` |
| `rejectRequest(requestId, adminId)` | Updates request to `rejected` |

### `PaymentGatewayRepository`
| Method | Description |
|--------|-------------|
| `getActiveGateways()` | All active gateways ordered by `sort_order` |
| `getAllGateways()` | All gateways |
| `createGateway(data)` | Create a new gateway |
| `updateGateway(id, data)` | Update existing gateway |
| `deleteGateway(id)` | Delete a gateway |

## Events / Listeners
None defined within the module.

## Integration with Rest of System
- **SubscriptionRequest module:** `PaymentRepository::requestSubscription()` creates a pending `SubscriptionRequestModel`. Approve/reject flow updates its status.
- **Package module:** `PaymentRepository` uses `PackageRepository` to get the price for the requested package.
- **Subscription module:** On approval, a `SubscriptionModel` is created with `active` status, start/end dates, and duration from the package.
- **Payment Gateway** stores sensitive config data in the `config` JSON column — these are credentials for external payment providers.
- `RequestSubscriptionForm` is defined here but consumed by `PlansPage` in the Package module.

## Config / Env Vars
None (gateway config is stored in the database `payment_gateways.config` column).

## Known Quirks / Dependencies
- Depends on `SubscriptionRequestModule` for subscription request lifecycle (create, find, update status).
- Depends on `PackageModule::PackageRepository` for price lookups.
- Depends on `SubscriptionModule::SubscriptionRepository` for creating active subscriptions on approval.
- `approveRequest()` creates a subscription directly without any payment confirmation — it assumes manual admin approval.
- No actual payment processing logic exists in this module; it manages gateway *configuration* and the subscription *request* workflow.
- Config is stored as a JSON column — sensitive values should be encrypted at the application level if needed.
- `PaymentGatewayRepository` uses static `PaymentGatewayModel::create()` and `PaymentGatewayModel::destroy()` directly, while the repository method takes `$data`.
