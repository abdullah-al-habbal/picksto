# LemonSqueezy Module

## Purpose
Integrates with the LemonSqueezy payment platform for subscription checkout, customer/product listing, and webhook processing. Uses the LemonSqueezy API directly — no Eloquent models (data lives in LemonSqueezy's system).

## Key Entities / Relationships
- **No Eloquent models** — `$model = null` on both resources.
- All data is fetched live from LemonSqueezy's REST API (`api.lemonsqueezy.com/v1/`).
- **Repository:** `LemonSqueezyRepository` — wraps all API calls.

## API Endpoints

### Repository Methods
| Method | API Call | Description |
|--------|----------|-------------|
| `createCheckout(userId, variantId, customData)` | `POST /v1/checkouts` | Creates checkout session, returns URL |
| `getProducts()` | `GET /v1/products` | List all products |
| `getProduct(id)` | `GET /v1/products/{id}` | Single product details |
| `getCustomers()` | `GET /v1/customers` | List all customers |
| `getCustomer(id)` | `GET /v1/customers/{id}` | Single customer details |
| `getCustomerSubscriptions(customerId)` | `GET /v1/subscriptions` | Subscriptions for a customer |
| `handleWebhook(payload, signature)` | — | Processes incoming webhook |

### Webhook Route
| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| POST | `/web/lemonsqueezy/webhook` | `HandleWebhookAction` | Receives LemonSqueezy webhooks (no CSRF, no auth middleware) |

### HTTP Requests
| Request | Purpose | Key Fields |
|---------|---------|------------|
| `CreateCheckoutRequest` | Create a checkout session | `variantId` (required, int), `redirectUrl` (nullable, URL), `customData` (nullable, array) |

## Admin Filament (Read-Only, API-Fetched)

| Resource | Pages | Model |
|----------|-------|-------|
| `LemonSqueezyProductResource` | List, View | `$model = null` |
| `LemonSqueezyCustomerResource` | List, View | `$model = null` |

Both use custom views (`list-api-records.blade.php`, `view-api-record.blade.php`) for displaying API data in Filament.
Navigation group: Payment (icon: shopping-bag / users).

## Events / Listeners
None defined. `handleWebhook()` currently logs events but does not dispatch application events or perform side effects.

## Integration with Rest of System
- **User module:** `createCheckout()` passes `user_id` in custom data for webhook reconciliation.
- **Subscription module:** Webhook handling is a stub — subscription creation/activation upon payment success would need to be wired up.
- Custom Filament views in `Resources/views/filament/pages/` use Blade with `module` namespace `lemon-squeezy::`.

## Config / Env Vars
| Key | Required | Description |
|-----|----------|-------------|
| `services.lemonsqueezy.api_key` | Yes | LemonSqueezy API key |
| `services.lemonsqueezy.store_id` | Yes | LemonSqueezy store ID |

These must be added to `config/services.php` and `.env`. Not present in `.env.example` — must be configured manually.

## Known Quirks / Dependencies
- **No Eloquent persistence** — all data is fetched live from LemonSqueezy API; no database tables or migrations.
- Custom Blade views (`list-api-records`, `view-api-record`) handle Filament table/infolist rendering differently from standard resources.
- `handleWebhook()` is a stub — it logs the event but does not process subscription creation, order fulfillment, or signature verification. The `$signature` parameter is received but not validated against the webhook secret.
- Webhook route has no CSRF or auth middleware (LemonSqueezy signs requests with a shared secret — validation is not yet implemented).
- The `CreateCheckoutRequest` casts `variantId` to integer during `prepareForValidation()`.
- Requires PHP's `ext-curl` or Guzzle for HTTP calls via `Illuminate\Support\Facades\Http`.
